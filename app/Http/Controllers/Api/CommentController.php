<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment(Quote $quote, Request $request){
        $user_id = Auth::id();

        $request->validate([
            'comment' => 'required|string'
        ]);

        $comment = Comment::create([
            'comment' => request('comment'),
            'user_id' => $user_id,
            'quote_id' => $quote->id, 
        ]);

        return $comment;

        
    }
}
