<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $posts = $user->posts;
        $lastPost =$posts->sortByDesc('id')->first();
        return [
            'id' => $user->id,
            'name' => $user->name,
            'count' => $posts->count(),
            'title of last post' => $lastPost->title,
            'link on picture of last post' => 'public/posts/'. $lastPost->picture
        ];
    }
}
