<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;
use App\Tag;
use App\Comment;

class BlogController extends Controller
{
	protected $limit = 4;

    public function index()
    {
      $posts = Post::with('author', 'tags', 'category', 'comments')
              ->latestFirst()
              ->published()
              ->filter(request()->only(['term', 'year', 'month']))
              ->simplePaginate($this->limit);

      return view('blog.index', compact('posts'));
    }


    public function Category(Category $category)
    {
        $categoryName = $category->title;
        $posts = $category->posts()
                          ->with('author', 'tags', 'comments')
                          ->latestFirst()
                          ->published()
                          ->simplePaginate($this->limit);

        return view("blog.index", compact('posts', 'categoryName'));
    }

    public function tag(Tag $tag)
    {
        $tagName = $tag->name;

        $posts = $tag->posts()
                            ->with('author', 'tags', 'category', 'comments')
                            ->published()
                            ->latestFirst()
                            ->simplePaginate($this->limit);
                            
        return view('blog.index', compact('posts', 'tagName'));
    }

    public function author(User $author)
    {
        $authorName = $author->name;
        $posts = $author->posts()
                          ->with('category', 'tags', 'comments')
                          ->latestFirst()
                          // ->published()
                          ->simplePaginate($this->limit);

        return view("blog.index", compact('posts', 'authorName'));
    }

    public function show(Post $post)
    {
      // way to count views
      $post->increment('view_count');

      $postComments = $post->comments()->simplePaginate(3);

    	return view("blog.show", compact('post', 'postComments'));
    }

    
}
