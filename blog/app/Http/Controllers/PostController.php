<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        $posts = Post::latest()-> orderBy('created_at','desc')->paginate(20);
        $data = array();
        $data['posts'] = $posts;
        return view('posts.index', $data);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $request->user()->posts()->create($request->only('body'));

        return back();
    }

    public function destroy(Post $post){
        $this->authorize('delete',$post);
        $post->delete();   
        return back();
    }
}
