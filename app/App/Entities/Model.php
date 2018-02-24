<?php

namespace SmartHome\App\Entities;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * @mixin \Illuminate\Database\Query\Builder
 */
abstract class Model extends Eloquent
{
    use Uuid;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
}