<?php

namespace SmartHome\Domain\Devices\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use SmartHome\App\Entities\Model;
use SmartHome\Domain\Devices\Filters\DevicePropertyLog\Filters;

class DevicePropertyLog extends Model
{
    protected $primaryKey = null;

    /**
     * @var array
     */
    protected $fillable = ['value'];

    /**
     * Ссылка на объект свойства
     *
     * @return BelongsTo
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(DeviceProperty::class, 'device_property_id');
    }

    /**
     * @param Builder $query
     * @param Request $request
     * @param array $filters
     * @return Builder
     */
    public function scopeFilter(Builder $query, Request $request, array $filters = [])
    {
        return (new Filters($request))->add($filters)->filter($query);
    }
}
