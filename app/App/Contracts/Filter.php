<?php

namespace SmartHome\App\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface Filter
{

    /**
     * Apply filter.
     *
     * @param  Builder $builder
     * @param  mixed $value
     *
     * @return Builder
     */
    public function filter(Builder $builder, $value): Builder;
}