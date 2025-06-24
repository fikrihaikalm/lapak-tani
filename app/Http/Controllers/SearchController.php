<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Education;
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        try {
            $request->validate([
                'query' => 'required|string|min:2|max:100'
            ]);

            $query = $request->input('query');
        $results = [];

        // Search Products
        $products = Product::with('user')
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'formatted_price' => $product->formatted_price,
                    'image_url' => $product->image_url,
                    'url' => route('product.show', $product->slug),
                    'user' => [
                        'name' => $product->user->name
                    ]
                ];
            });

        // Search Education Articles
        $articles = Education::with('user')
            ->where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get()
            ->map(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'url' => route('education.show', $article->slug),
                    'user' => [
                        'name' => $article->user->name
                    ]
                ];
            });

        // Search Farmers
        $farmers = User::where('user_type', 'petani')
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('farm_name', 'LIKE', "%{$query}%");
            })
            ->limit(5)
            ->get()
            ->map(function ($farmer) {
                return [
                    'id' => $farmer->id,
                    'name' => $farmer->name,
                    'farm_name' => $farmer->farm_name,
                    'avatar_url' => $farmer->avatar_url,
                    'url' => route('petani.profile', $farmer->slug ?: $farmer->id)
                ];
            });

            return response()->json([
                'products' => $products,
                'articles' => $articles,
                'farmers' => $farmers
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat mencari',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
