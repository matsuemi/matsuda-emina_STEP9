<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = [
        'company_name',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function likes(): HasMany
    {
    return $this->hasMany(Like::class);
    }
}