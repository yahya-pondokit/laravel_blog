<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;
use App\Tag;

class BlogController extends Controller
{
	protected $limit = 3;

    public function index()
    {
      $posts = Post::with('author', 'tags', 'category')
              ->latestFirst()
                            ->published()
                            ->filter(request('term'))
                            ->simplePaginate($this->limit);

      return view('blog.index', compact('posts'));
    }


    public function Category(Category $category)
    {
        $categoryName = $category->title;
        $posts = $category->posts()
                          ->with('author', 'tags')
                          ->latestFirst()
                          // ->published()
                          ->simplePaginate($this->limit);

        return view("blog.index", compact('posts', 'categoryName'));
    }

    public function tag(Tag $tag)
    {
        $tagName = $tag->name;

        $posts = $tag->posts()
                            ->with('author', 'tags', 'category')
                            ->published()
                            ->latestFirst()
                            ->simplePaginate($this->limit);
                            
        return view('blog.index', compact('posts', 'tagName'));
    }

    public function author(User $author)
    {
        $authorName = $author->name;
        $posts = $author->posts()
                          ->with('category', 'tags')
                          ->latestFirst()
                          // ->published()
                          ->simplePaginate($this->limit);

        return view("blog.index", compact('posts', 'authorName'));
    }

    public function show(Post $post)
    {
      // way to count views
      $post->increment('view_count');
    	return view("blog.show", compact('post', 'categories'));
    }

    
}
