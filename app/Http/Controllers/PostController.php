<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use DateTime;
use Illuminate\Support\Facades\File; 

// File
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys= Category::all();
        $posts= Post::orderBy('id','desc')->paginate(20);
        return view('admin.post', compact('posts', 'categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category=Category::find($request->category);
        $request->validate([
            'title'=>'required|unique:posts,title',
            'category'=>'required',
            'image'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if (isset($request->image)) {
            $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/post'), $imageName);
        }
        

        Post::insert([
            'title'=> $request->title,
            'category_id'=> $request->category,
            'category'=> $category->name,
            'image'=> $imageName,
            'user_id'=> 2,
            'description'=> $request->description,
            'publish_at'=> new DateTime('now'),
        ]);
        return redirect()->back()->with('success','Post created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categorys= Category::all();
        return view('admin.post_edit', compact('post', 'categorys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        
        $category=Category::find($request->category);
        $id= $post->id;
        $request->validate([
            'title'=>'required|unique:posts,title,'.$id,
            
            'category'=>'required',
        ]);
        
        $post->update([
            'title'=> $request->title,
            'category_id'=> $request->category,
            'category'=> $category->name,
            'image'=> $request->image,
            'description'=> $request->description,
        ]);
        return redirect()->back()->with('success','Post Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {


        if ($post) {

            $image_path = "images/post/".$post->image;

            if (File::exists($image_path)) {
                File::delete($image_path);
                //unlink($image_path);
            }

            $post->delete();
            return redirect()->back()->with('success','Post Delete successfully!');
        }
    }
}
