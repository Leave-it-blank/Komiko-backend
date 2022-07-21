<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
 
class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'position', 'code', 'expires_at', 'is_enabled',
    ];
    protected $dates = [
        'expires_at',
    ];

    /**
     * @return bool
     */
    public function isExpired()
    {
        return $this->expires_at !== null &&
            $this->expires_at < now()->toDateTimeString();
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeIsEnabled(Builder $query)
    {
        return $query->where('is_enabled', true);
    }
}
