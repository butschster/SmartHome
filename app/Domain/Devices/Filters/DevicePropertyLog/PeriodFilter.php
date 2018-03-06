<?php

namespace SmartHome\Domain\Devices\Filters\DevicePropertyLog;

use Illuminate\Database\Eloquent\Builder;
use SmartHome\App\Filters\Filter;

class PeriodFilter extends Filter
{
    /**
     * Database value mappings.
     *
     * @return array
     */
    public function mappings(): array
    {
        return [
            'day' => 'day',
            'week' => 'week',
            'month' => 'month',
            'year' => 'year'
        ];
    }

    /**
     * Apply filter.
     *
     * @param  Builder $builder
     * @param  mixed $value
     *
     * @return Builder
     */
    public function filter(Builder $builder, $value): Builder
    {
        $method = $this->resolveFilterValue($value);

        if (!$value) {
            return $builder;
        }

        return $this->$method($builder);
    }

    /**
     * @param Builder $builder
     * @return mixed
     */
    protected function day(Builder $builder)
    {
        return $builder->where('created_at', '>=', now()->subDay()->toDateTimeString());
    }

    /**
     * @param Builder $builder
     * @return mixed
     */
    protected function month(Builder $builder)
    {
        return $builder->where('created_at', '>=', now()->subMonth()->toDateTimeString());
    }

    /**
     * @param Builder $builder
     * @return mixed
     */
    protected function week(Builder $builder)
    {
        return $builder->where('created_at', '>=', now()->subWeek()->toDateTimeString());
    }

    /**
     * @param Builder $builder
     * @return mixed
     */
    protected function year(Builder $builder)
    {
        return $builder->where('created_at', '>=', now()->subYear()->toDateTimeString());
    }
}