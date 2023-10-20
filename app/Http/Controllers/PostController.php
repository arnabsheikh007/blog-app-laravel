<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request){
        $incomingFields = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        $incomingFields['user_id'] = Auth()->id();

        Post::create($incomingFields);

        return redirect('/');
    }

    public function showEditForm(Post $post){
        if(auth()->user()->id !== $post['user_id'] ){
            return redirect('/');
        }
        return view('edit-post',['post' => $post]);
    }

    public function updatePost(Post $post, Request $request){
        if(auth()->user()->id !== $post['user_id'] ){
            return redirect('/');
        }
        $incomingFields = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);

        $post->update($incomingFields);
        return redirect('/');
    }

    public function deletePost(Post $post){
        if(auth()->user()->id === $post['user_id'] ){
            $post->delete();
        }
        return redirect('/');

    }
}