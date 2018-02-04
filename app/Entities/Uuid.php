<?php

namespace App\Entities;

use Ramsey\Uuid\Uuid as UuidGenerator;

trait Uuid
{
    public static function bootUuid()
    {
        static::creating(function ($model) {
            if ($model->getKeyName()) {
                $model->{$model->getKeyName()} = UuidGenerator::uuid4()->toString();
            }
        });
    }
}