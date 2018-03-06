<?php

namespace SmartHome\App\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface Filters
{
    /**
     * Add filters.
     *
     * @param array $filters
     * @return static
     */
    public function add(array $filters): Filters;

    /**
     * Apply filters.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filter(Builder $builder): Builder;
}