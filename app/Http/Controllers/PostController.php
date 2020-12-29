<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use DateTime;
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
        ]);
        Post::insert([
            'title'=> $request->title,
            'category_id'=> $request->category,
            'category'=> $category->name,
            'image'=> $request->image,
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
            $post->delete();
            return redirect()->back()->with('success','Post Delete successfully!');
        }
    }
}
