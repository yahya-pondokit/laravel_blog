<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Datatables;

class DatatablesController extends Controller
{
    public function getIndex()
    {
    	return view('backend.blog.index');
    }

    public function data()
    {
    	return Datatables::of(Post::query())->make(true);
    }
}
