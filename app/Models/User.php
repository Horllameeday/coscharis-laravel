<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserProfileStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\UsesUUID;
use DateTimeInterface;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, UsesUUID;
    use HasApiTokens {
        HasApiTokens::createToken as sanctumCreateToken;
    }

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
        'updated_at'
    ];

    protected $casts = [
        'status' => UserProfileStatus::class,
        'email_verified_at' => 'datetime',
        'phone_number_verified_at' => 'datetime',
    ];

    // protected $dispatchesEvents = [
    //     'created' => Registered::class,
    // ];

    // protected static function booted()
    // {
    //     parent::booted();
    //     static::creating(function (self $user) {
    //         if (empty($user->status)) {
    //             $user->status = UserProfileStatus::ENABLED;
    //         }
    //     });
    // }

    protected function firstName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value)
        );
    }

    protected function email(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtolower($value),
            set: fn ($value) => strtolower($value)
        );
    }

    protected function lastName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value)
        );
    }

    protected function phoneNumber(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => ucwords($value),
            set: fn ($value) => phone($value, 'NG')->formatE164()
        );
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value)
        );
    }

    public function fullName(): string
    {
        return "$this->firstName $this->lastName";
    }

    public function createToken(string $name, array $abilities = ['*'], ?DateTimeInterface $expiresAt = null)
    {
        $token = $this->sanctumCreateToken($name, $abilities, $expiresAt);

        $token->plainTextToken = Crypt::encryptString($token->plainTextToken);

        return $token;
    }

    public function isEnabled(): bool
    {
        return $this->status == UserProfileStatus::ENABLED;
    }

    public function hasVerifiedPhoneNumber(): bool
    {
        return $this->phone_number_verified_at !== null;
    }

    public function markPhoneNumberAsVerified(): bool
    {
        return $this->forceFill([
            'phone_number_verified_at' => now(),
        ])->save();
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class, 'user_id');
    }

    public function shipmentsAsDriver()
    {
        return $this->hasMany(Shipment::class, 'driver_id');
    }
}
