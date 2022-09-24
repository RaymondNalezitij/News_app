<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Category extends Authenticatable
{

    protected $fillable = [
        'name',
    ];

    public function Post(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
