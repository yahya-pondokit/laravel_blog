<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use Intervention\Image\Facades\Image;
use App\Post;
use DataTables;

class BlogController extends BackendController
{
    protected $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path(config('cms.image.directory'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $onlyTrashed = FALSE;

        if (($status = $request->get('status')) && $status == 'trash')
        {
            $posts      = Post::onlyTrashed()->with('category', 'author')->latest()->paginate($this->limit);
            $postCount  = Post::onlyTrashed()->count();
            $onlyTrashed = TRUE;
        }
        elseif ($status == 'published')
        {
            $posts      = Post::published()->with('category', 'author')->latest()->paginate($this->limit);
            $postCount  = Post::published()->count();
        }
        elseif ($status == 'scheduled')
        {
            $posts      = Post::scheduled()->with('category', 'author')->latest()->paginate($this->limit);
            $postCount  = Post::scheduled()->count();
        }
        elseif ($status == 'draft')
        {
            $posts      = Post::draft()->with('category', 'author')->latest()->paginate($this->limit);
            $postCount  = Post::draft()->count();
        }
        elseif ($status == 'own') 
        {
            $posts       = $request->user()->posts()->with('author','category')->latest()->paginate($this->limit);
            $postCount   = $request->user()->posts()->count();
        }
        else
        {
            $posts      = Post::with('category', 'author')->latest()->paginate($this->limit);
            $postCount  = Post::count();
        }

        $statusList = $this->statusList($request);

        return view("backend.blog.index", compact('posts', 'postCount', 'onlyTrashed', 'statusList'));
    }

    public function dataPost()
    { 
        $post = Post::with('author', 'category');
        return DataTables::of($post)
                ->addColumn('action', function($user) {
                    $submit = '<button onclick="return confirm('."'Are you sure?'".')" type="submit" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>' ;

                    return '<form action="'.route('backend.blog.destroy', $user->id).'" method="post">' . csrf_field() . method_field("DELETE") . '<a href="' . route('backend.blog.edit', $user->id).'" class="btn btn-xs btn-default"><i class="fa fa-edit"></i></a>'.$submit.'</form>';
                })
                ->addColumn('author', function($post) {
                    return $post->author->name;
                })
                ->addColumn('category', function($post) {
                    return $post->category->title;
                })
                ->addColumn('date', function($post) {
                    return $post->dateFormatted(true);
                })
                ->make(true);
    }

    private function statusList($request)
    {
        return [
            'own'       => $request->user()->posts()->count(),
            'all'       => Post::count(),
            'published' => Post::published()->count(),
            'scheduled' => Post::scheduled()->count(),
            'draft'     => Post::draft()->count(),
            'trash'     => Post::onlyTrashed()->count(),
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('backend.blog.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\PostRequest $request)
    {
        if($request->check == 'nii-san, daisuki desu!!(>_<)'){
            $request->validate([
                'published_at' => 'date_format:Y-m-d H:i:s'
            ]);
        }

        $data = $this->handleRequest($request);

        $newPost    =   $request->user()->posts()->create($data);
        $newPost->createTags($data["post_tags"]);

        return redirect( route('backend.blog.index') )->with('success', 'Your post was created successfully!!');
    }

    private function handleRequest($request)
    {
        $data = $request->all();

        if ($request->hasFile('image'))
        {
            $image          = $request->file('image');
            $fileName       = $image->getClientOriginalName();
            $destination    = $this->uploadPath;

            $successUploaded = $image->move($destination, $fileName);

            if ($successUploaded)
            {
                $width          = config('cms.image.thumbnail.width');
                $height          = config('cms.image.thumbnail.height');
                $extension      = $image->getClientOriginalExtension();
                $thumbnail      = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                Image::make($destination . '/' . $fileName)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
            }
        
            $data['image'] = $fileName;
        }

        return $data;
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
        $post = Post::findOrFail($id);
        return view("backend.blog.edit", compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\PostRequest $request, $id)
    {
        $post       = Post::findOrFail($id);
        $oldImage   = $post->image;
        $data       = $this->handleRequest($request);
        $post->update($data);

        if ($oldImage !== $post->image) {
            $this->removeImage($oldImage);
        }
        return redirect( route('backend.blog.index') )->with('success', 'Your post was updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
        return redirect( route('backend.blog.index') )->with('trash-message', ['Your post moved to Trash', $id]);
    }

    public function forceDestroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();

        $this->removeImage($post->image); 

        return redirect('/backend/blog?status=trash')->with('success', 'Your post has been deleted successfully');
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->back()->with('success', 'Your post has been revived from the dead');
    }

    private function removeImage($image)
    {
        if ( ! empty($image) )
        {
            $imagePath = $this->uploadPath . '/' . $image;
            $ext = substr(strrchr($image, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $image);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;

            if ( file_exists($imagePath) ) unlink($imagePath);
            if ( file_exists($thumbnailPath) ) unlink($thumbnailPath);
        } 
    }
}