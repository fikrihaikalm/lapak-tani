<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(Request $request, User $user)
    {
        $currentUser = auth()->user();
        
        if ($currentUser->id === $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak dapat mengikuti diri sendiri'
            ]);
        }
        
        if ($currentUser->follow($user->id)) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengikuti ' . $user->name,
                'is_following' => true,
                'followers_count' => $user->followers_count
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Anda sudah mengikuti pengguna ini'
        ]);
    }
    
    public function unfollow(Request $request, User $user)
    {
        $currentUser = auth()->user();
        
        if ($currentUser->unfollow($user->id)) {
            return response()->json([
                'success' => true,
                'message' => 'Berhenti mengikuti ' . $user->name,
                'is_following' => false,
                'followers_count' => $user->followers_count
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Anda tidak mengikuti pengguna ini'
        ]);
    }
    
    public function followers(User $user)
    {
        $followers = $user->followers()
            ->withPivot('created_at')
            ->orderBy('pivot_created_at', 'desc')
            ->paginate(20);
            
        return view('social.followers', compact('user', 'followers'));
    }
    
    public function following(User $user)
    {
        $following = $user->following()
            ->withPivot('created_at')
            ->orderBy('pivot_created_at', 'desc')
            ->paginate(20);
            
        return view('social.following', compact('user', 'following'));
    }
}
