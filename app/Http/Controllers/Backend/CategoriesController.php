<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Post;
use DataTables;

class CategoriesController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("backend.categories.index");
        //, compact('categories', 'categoriesController', 'categoriesCount')
    }



    public function dataCategory()
    { 
        $cat = Category::with('posts');
        return DataTables::of($cat)
                ->addColumn('action', function($category) {
                    $submit = ($category->id == config('cms.default_category_id')) ? '<button onclick="return false" type="submit" class="btn btn-xs btn-danger disabled"><i class="fa fa-times"></i></button>' : '<button onclick="return confirm('."'Are you sure?'".')" type="submit" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>' ;

                    return '<form action="'.route('backend.categories.destroy', $category->id).'" method="post">' . csrf_field() . method_field("DELETE") . '<a href="' . route('backend.categories.edit', $category->id).'" class="btn btn-xs btn-default"><i class="fa fa-edit"></i></a>'.$submit.'</form>';
                })
                ->addColumn('post-count', function($category) {
                    return $category->posts->count();
                })
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        return view("backend.categories.create", compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CategoryStoreRequest $request)
    {
        Category::create($request->all());

        return redirect("/backend/categories")->with("success", "New category was created succesfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view("backend.categories.edit", compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\CategoryUpdateRequest $request, $id)
    {
        Category::findOrFail($id)->update($request->all());

        return redirect("/backend/categories")->with("success", "Category was updated succesfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requests\CategoryDestroyRequest $request, $id)
    {
        Post::withTrashed()->where('category_id', $id)->update(['category_id' => config('cms.default_category_id')]);

        $category = Category::findOrFail($id);
        $category->delete();

        return redirect("/backend/categories")->with("success", "Category was deleted succesfully!");
    }
}
