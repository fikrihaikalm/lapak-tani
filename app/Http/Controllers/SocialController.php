<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostLike;
use App\Models\PostComment;
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
            ->with(['user', 'likes', 'comments.user'])
            ->posts()
            ->active()
            ->latest()
            ->paginate(10);

        $stories = Post::whereIn('user_id', $followingIds)
            ->with('user')
            ->stories()
            ->active()
            ->latest()
            ->get()
            ->groupBy('user_id');

        return view('social.feed', compact('posts', 'stories'));
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'images.*' => 'nullable|image|max:2048',
            'type' => 'required|in:post,story',
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('posts', 'public');
            }
        }

        $expiresAt = null;
        if ($request->type === 'story') {
            $expiresAt = now()->addHours(24);
        }

        Post::create([
            'user_id' => auth()->id(),
            'content' => $request->content,
            'images' => $images,
            'type' => $request->type,
            'expires_at' => $expiresAt,
        ]);

        return response()->json([
            'success' => true,
            'message' => $request->type === 'story' ? 'Story berhasil dibuat!' : 'Post berhasil dibuat!',
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

    public function commentPost(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|string|max:500',
        ]);

        $comment = PostComment::create([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
            'comment' => $request->comment,
        ]);

        $comment->load('user');

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil ditambahkan!',
            'comment' => [
                'id' => $comment->id,
                'comment' => $comment->comment,
                'user_name' => $comment->user->name,
                'user_avatar' => $comment->user->avatar_url,
                'time_ago' => $comment->time_ago,
            ]
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
            ->with(['likes', 'comments'])
            ->posts()
            ->active()
            ->latest()
            ->paginate(10);

        $isFollowing = auth()->check() && auth()->user()->isFollowing($user);
        
        $stats = [
            'followers_count' => $user->followers()->count(),
            'following_count' => $user->following()->count(),
            'posts_count' => Post::where('user_id', $id)->posts()->active()->count(),
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

        return view('social.profile', compact('user', 'posts', 'isFollowing', 'stats', 'orders', 'wishlist'));
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
