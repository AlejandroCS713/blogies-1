<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function index(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)->latest()->get();
        return view('comments.postComment', compact('post', 'comments'));
    }
}
