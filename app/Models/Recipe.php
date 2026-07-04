<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipe extends Model
{
    protected $fillable = ['title', 'category_id', 'description', 'cooking_time', 'portions', 'instructions', 'image_url'];

    /**
     * Relasi: Resep belongs to Category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi: Resep has many ingredients (pivot table)
     */
    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients')
            ->withPivot('quantity', 'required_qty', 'total_price_for_this_recipe')
            ->withTimestamps();
    }

    /**
     * Menghitung total harga semua bahan untuk resep ini
     */
    public function getTotalPriceAttribute(): float
    {
        return $this->ingredients()->sum('recipe_ingredients.total_price_for_this_recipe');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function getRatingBreakdownAttribute()
    {
        $total = $this->reviews()->count();
        $breakdown = [];
        
        for ($i = 5; $i >= 1; $i--) {
            $count = $this->reviews()->where('rating', $i)->count();
            $percentage = $total > 0 ? ($count / $total) * 100 : 0;
            $breakdown[$i] = [
                'count' => $count,
                'percentage' => round($percentage)
            ];
        }

        return [
            'total' => $total,
            'stars' => $breakdown
        ];
    }
}