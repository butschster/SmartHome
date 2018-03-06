<?php

namespace SmartHome\App\Filters;

use SmartHome\App\Contracts\Filter as FilterContract;

abstract class Filter implements FilterContract
{
    /**
     * Database value mappings.
     *
     * @return array
     */
    public function mappings(): array
    {
        return [];
    }

    /**
     * Resolve the value used for filtering.
     *
     * @param  mixed $key
     * @return mixed
     */
    protected function resolveFilterValue($key)
    {
        return array_get($this->mappings(), $key);
    }

    /**
     * Resolve the order direction to be used.
     *
     * @param  string $direction
     * @return string
     */
    protected function resolveOrderDirection($direction): string
    {
        return $direction == 'desc' ? 'desc' : 'asc';
    }
}
