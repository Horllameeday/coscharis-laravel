<?php

namespace App\Traits;

trait GetsTableName
{
    public static function getTableName()
    {
        return (new static)->getTable();
    }
}
