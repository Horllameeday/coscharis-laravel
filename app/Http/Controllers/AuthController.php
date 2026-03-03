<?php

namespace App\Http\Controllers;

use App\Enums\OTPVerificationEnum;
use App\Enums\TokenAbility;
use App\Http\Requests\VerifyOtpRequest;
use App\Jobs\Verification\SendSMSVerificationJob;
use App\Models\OtpVerification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Response;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Exception;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        try {
            $user = User::create($request->validated());

            $user = $user->fresh();

            event(new Registered($user));

            Log::info('Registration: User created!', [
                'user_id' => $user->id,
            ]);

            return $this->response(Response::HTTP_CREATED, 'Registration successful', $user);
        } catch (Exception $e) {
            Log::error('Registration Error: user creation failed!', [
                'exception' => $e,
                'data' => $request->except('password'),
            ]);

            return $this->response(Response::HTTP_INTERNAL_SERVER_ERROR, 'User creation failed');
        }
    }

    public function login(LoginRequest $request)
    {
        $phoneNumber = phone($request->username, 'NG')->formatE164();

        $user = User::where('phone_number', $phoneNumber)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

            Log::info('Login Error: Wrong credentials', [
                'username' => $request->username,
            ]);

            return $this->response(Response::HTTP_BAD_REQUEST, 'Credentials mismatch');
        }

        if (!$user->isClient()) {
            Log::warning('User login failed: Login attempt from non-client user', [
                'user_id' => $user->id,
            ]);

            return $this->response(Response::HTTP_FORBIDDEN, 'Not authorised to login');
        }

        if (!$user->isEnabled()) {
            Log::info('Login Error: User disabled', [
                'user_id' => $user->id,
                'full name' => $user->fullName,
            ]);

            return $this->response(Response::HTTP_BAD_REQUEST, 'User disabled');
        }

        if (!$user->hasVerifiedPhoneNumber()) {
            SendSMSVerificationJob::dispatch($user);
        }

        $expires_at = Carbon::now()->addMinutes(config('sanctum.expiration'));
        $token = $user->createToken("{$user->first_name}-{$user->id}-token", [TokenAbility::CLIENT_ACCESS->value], $expires_at);

        Log::info('Login: User logged in!', [
            'user_id' => $user->id,
        ]);

        $user->last_login = now();
        $user->save();

        $data = [
            'user' => $user,
            'token' => $token->plainTextToken,
            'token_type' => 'bearer',
            'expiry' => $expires_at,
        ];

        return $this->response(Response::HTTP_OK, 'Login successful', $data);
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            Log::info('Email already verified', ['user_id' => $request->user()->id]);
            return $this->response(Response::HTTP_OK, 'Email already verified');
        }

        $request->fulfill();

        Log::info('Email verified successfully', ['user_id' => $request->user()->id]);

        return $this->response(Response::HTTP_OK, 'Email verified successfully');
    }

    public function verifyOtp(VerifyOtpRequest $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedPhoneNumber()) {
            return $this->response(Response::HTTP_OK, 'Phone number already verified');
        }

        $otpVerification = OtpVerification::where('phone_number', $user->phone_number)
            ->where('pin', $request->otp)
            ->where('status', OTPVerificationEnum::PENDING)
            ->latest()
            ->first();

        if (!$otpVerification) {
            Log::warning('OTP verification failed: invalid or expired OTP', [
                'user_id' => $user->id,
            ]);
            return $this->response(Response::HTTP_BAD_REQUEST, 'Invalid or expired OTP');
        }

        $otpVerification->validate();
        $user->markPhoneNumberAsVerified();

        Log::info('Phone number verified successfully', [
            'user_id'      => $user->id,
            'phone_number' => $user->phone_number,
        ]);

        return $this->response(Response::HTTP_OK, 'Phone number verified successfully');
    }

    public function resendOtp(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedPhoneNumber()) {
            return $this->response(Response::HTTP_OK, 'Phone number already verified');
        }

        SendSMSVerificationJob::dispatch($user);

        Log::info('OTP resend requested', ['user_id' => $user->id]);

        return $this->response(Response::HTTP_OK, 'OTP resent successfully');
    }
}
