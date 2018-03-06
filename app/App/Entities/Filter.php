<?php

namespace SmartHome\App\Entities;

trait Filter
{
    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new CourseFilters(request()))->add($filters)->filter($builder);
    }
}