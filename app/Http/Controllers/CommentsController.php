<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentStoreRequest;
use App\Comment;

class CommentsController extends Controller
{
    public function store(CommentStoreRequest $request)
    {
    	// $post->createComment($request->all());
    	$data = $request->all();

    	Comment::create($data);

    	return redirect()->back()->with('message', "Your comment has been sent successfully. Thank you <3");
    }
}
