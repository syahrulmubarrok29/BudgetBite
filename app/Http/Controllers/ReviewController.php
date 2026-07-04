<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Recipe;
use App\Models\Review;
use App\Models\ReviewLike;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function index($recipeId)
    {
        $recipe = Recipe::findOrFail($recipeId);
        
        $reviews = Review::with('user:id,name')
            ->withCount('likes')
            ->where('recipe_id', $recipeId)
            ->orderByDesc('is_featured')
            ->orderByDesc('created_at')
            ->paginate(5);

        // Append has_liked for current user if logged in
        $userId = auth()->id();
        if ($userId) {
            $reviews->getCollection()->transform(function ($review) use ($userId) {
                $review->has_liked = ReviewLike::where('review_id', $review->id)
                    ->where('user_id', $userId)
                    ->exists();
                return $review;
            });
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'reviews' => $reviews,
                'breakdown' => $recipe->rating_breakdown,
                'average_rating' => round($recipe->average_rating, 1)
            ]
        ]);
    }

    public function store(Request $request, $recipeId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|max:2048' // max 2MB
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('reviews', 'public');
            // convert to absolute url
            $photoPath = url('storage/' . $photoPath);
        }

        $review = Review::updateOrCreate(
            ['recipe_id' => $recipeId, 'user_id' => auth()->id()],
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
                'photo_path' => $photoPath,
            ]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Ulasan berhasil disimpan.',
            'data' => $review
        ]);
    }

    public function toggleLike($id)
    {
        $review = Review::findOrFail($id);
        $userId = auth()->id();

        $like = ReviewLike::where('review_id', $id)->where('user_id', $userId)->first();

        if ($like) {
            $like->delete();
            return response()->json(['status' => 'success', 'message' => 'Unliked', 'action' => 'unliked']);
        } else {
            ReviewLike::create(['review_id' => $id, 'user_id' => $userId]);
            return response()->json(['status' => 'success', 'message' => 'Liked', 'action' => 'liked']);
        }
    }
}
