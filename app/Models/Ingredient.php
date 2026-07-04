<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredient extends Model
{
    protected $fillable = ['name', 'unit', 'price_per_unit', 'base_qty'];

    /**
     * Relasi: Satu ingredient bisa digunakan di banyak recipe_ingredients
     */
    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class, 'recipe_ingredients')
            ->withPivot('quantity', 'required_qty', 'total_price_for_this_recipe')
            ->withTimestamps();
    }
}