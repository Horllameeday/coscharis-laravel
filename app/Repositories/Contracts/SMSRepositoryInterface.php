<?php

namespace App\Repositories\Contracts;

interface SMSRepositoryInterface
{
    public function sendSMS(string $phoneNumber, string $message);
}
