<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * Relasi: Satu kategori memiliki banyak resep
     */
    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class);
    }
}