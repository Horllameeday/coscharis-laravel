<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait StringID
{
    protected static function booted()
    {
        // parent::booted();
        static::creating(function (Model $model) {
            $id = explode('-', Str::uuid());
            $model->setAttribute($model->getKeyName(), $id);
        });
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}
