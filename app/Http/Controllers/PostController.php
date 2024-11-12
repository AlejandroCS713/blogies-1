<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class PostController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        $posts = DB::table(table:'posts')->get();

        /*$posts = Post::where('published_at', '<=', Carbon::now())->get();*/
        $posts = Post::where('published_at', '<=', now())->paginate(9);
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $comments = $post->comments()->latest()->get();
        return view('posts.show', compact('post', 'comments'));
    }

    public function create()
    {
        return view('posts.create', ['post' => new Post()]);
    }

    public function store(StorePostRequest $request)
    {
        Post::create(array_merge($request->validated(), [
            'user_id' => auth()->id(),
        ]));
        return to_route('posts.index')
            ->with('status', 'Post created successfully');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function  update(UpdatePostRequest $request, Post $post)
    {
        Post::updated(array_merge($request->validated(), [
            'user_id' => auth()->id(),
        ]));
        return to_route('posts.show', $post)
            ->with('status', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return to_route('posts.index')
            ->with('status', 'Post deleted successfully');
    }

    public function user()
    {
        $userId = Auth::id();

        // Cambia 'get()' por 'paginate()' para habilitar la paginación
        $posts = Post::where('user_id', $userId)->paginate(9);

        return view('posts.user', compact('posts'));
    }

}
