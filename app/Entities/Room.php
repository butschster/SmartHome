<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    /**
     * @param BasicRelay $relay
     */
    /**
     * @var array
     */
    protected $fillable = ['name', 'position'];

    /**
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'position' => 'integer'
    ];

    /**
     * @return HasMany
     */
    public function objects(): HasMany
    {
        return $this->hasMany(Object::class);
    }
}
