<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'recipe_id',
        'user_id',
        'rating',
        'comment',
        'photo_path',
        'admin_reply',
        'is_featured'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function likes()
    {
        return $this->hasMany(ReviewLike::class);
    }
}
