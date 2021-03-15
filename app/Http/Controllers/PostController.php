<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->paginate(3);
        return view('posts.allPosts', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.createPost');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:10|string',
            'alt_text' => 'required|max:10|string',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->has('picture'))
        {
            $imageName = $request->picture->getClientOriginalName();
            $request->file('picture')->move('posts', $imageName);
            $data['picture'] = $imageName;
        }

        Post::create($data);

        return redirect()->route('all-posts');
    }


    public function show(Post $post)
    {
        return view('posts.showPost', [
            'post' => $post,
        ]);
    }

    public function edit(Post $post, Request $request)
    {
        $request->validate([
            'title' => 'required|max:10|string',
            'alt_text' => 'required|max:10|string',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->has('picture'))
        {
            $imageName = $request->picture->getClientOriginalName();
            $request->file('picture')->move('posts', $imageName);
            $data['picture'] = $imageName;
        }

        $post->update($data);

        return redirect()->route('all-posts');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('all-posts');
    }

}
