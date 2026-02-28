<?php

namespace App\Models;

use App\Enums\OTPVerificationEnum;
use App\Traits\UsesUUID;
use Illuminate\Database\Eloquent\Builder;

class OtpVerification extends BaseModel
{
    use UsesUUID;

    protected $fillable = [
        'pin',
        'phone_number',
        'status',
    ];

    public function scopeValidated(Builder $query)
    {
        return $query->where('status', OTPVerificationEnum::VALIDATED);
    }

    public function scopePending(Builder $query)
    {
        return $query->where('status', OTPVerificationEnum::PENDING);
    }

    public function validate()
    {
        $this->status = OTPVerificationEnum::VALIDATED;

        return $this->save();
    }
}
