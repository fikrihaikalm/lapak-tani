<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostLike;

use App\Models\Follow;
use App\Models\User;
use App\Models\Order;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function feed()
    {
        $user = auth()->user();
        
        // Get posts from followed users and own posts
        $followingIds = $user->following()->pluck('users.id')->toArray();
        $followingIds[] = $user->id;

        $posts = Post::whereIn('user_id', $followingIds)
            ->with(['user', 'likes'])
            ->active()
            ->latest()
            ->paginate(10);

        return view('social.feed', compact('posts'));
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'images.*' => 'nullable|image|max:2048',

        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('posts', 'public');
            }
        }

        Post::create([
            'user_id' => auth()->id(),
            'content' => $request->content,
            'images' => $images,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil dibuat!',
            'redirect' => route('social.feed')
        ]);
    }

    public function likePost(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        $like = PostLike::where('user_id', auth()->id())
            ->where('post_id', $request->post_id)
            ->first();

        if ($like) {
            $like->delete();
            $action = 'unliked';
        } else {
            PostLike::create([
                'user_id' => auth()->id(),
                'post_id' => $request->post_id,
            ]);
            $action = 'liked';
        }

        $likesCount = PostLike::where('post_id', $request->post_id)->count();

        return response()->json([
            'success' => true,
            'action' => $action,
            'likes_count' => $likesCount
        ]);
    }



    public function followUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        if ($request->user_id == auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak bisa follow diri sendiri!'
            ]);
        }

        $follow = Follow::where('follower_id', auth()->id())
            ->where('following_id', $request->user_id)
            ->first();

        if ($follow) {
            $follow->delete();
            $action = 'unfollowed';
            $message = 'Berhenti mengikuti pengguna!';
        } else {
            Follow::create([
                'follower_id' => auth()->id(),
                'following_id' => $request->user_id,
            ]);
            $action = 'followed';
            $message = 'Berhasil mengikuti pengguna!';
        }

        return response()->json([
            'success' => true,
            'action' => $action,
            'message' => $message
        ]);
    }

    public function userProfile($id)
    {
        $user = User::with(['products', 'educations'])->findOrFail($id);
        
        $posts = Post::where('user_id', $id)
            ->with(['likes'])
            ->latest()
            ->paginate(10);

        $isFollowing = auth()->check() && auth()->user()->isFollowing($user);
        
        $stats = [
            'followers_count' => $user->followers()->count(),
            'following_count' => $user->following()->count(),
            'posts_count' => Post::where('user_id', $id)->count(),
            'products_count' => $user->products()->count(),
        ];

        // Additional data for konsumen
        $orders = null;
        $wishlist = null;

        if ($user->isKonsumen() && auth()->check() && auth()->id() === $user->id) {
            $orders = Order::where('user_id', $user->id)
                ->with(['petani', 'items.product'])
                ->latest()
                ->take(10)
                ->get();

            $wishlist = Wishlist::where('user_id', $user->id)
                ->with('product.user')
                ->latest()
                ->get();
        }

        // Get followers and following data
        $followers = $user->followers()->with('userType')->get();
        $following = $user->following()->with('userType')->get();

        return view('social.profile', compact('user', 'posts', 'isFollowing', 'stats', 'orders', 'wishlist', 'followers', 'following'));
    }

    public function viewStories(User $user)
    {
        $stories = Post::where('user_id', $user->id)
            ->where('type', 'story')
            ->where('created_at', '>=', now()->subHours(24))
            ->orderBy('created_at', 'asc')
            ->get();

        if ($stories->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada story yang tersedia');
        }

        return view('social.stories', compact('user', 'stories'));
    }
}
