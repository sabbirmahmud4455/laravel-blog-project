<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\File; 

// File
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    
    /**
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys= Category::all();
        $tags= Tag::all();
        $posts= Post::with(["post_tag", "user", "category"])->orderBy('id','desc')->paginate(20);

        return view('admin.post', compact(['posts', 'categorys', 'tags']));
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
        $request->validate([
            'title'=>'required|unique:posts,title',
            'category'=>'required',
            'image'=> 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);


        if (isset($request->image)) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/post'), $imageName);
        }
        
        $post= new Post();

            $post->title = $request->title;
            $post->category_id = $request->category;
            if (isset($request->image)) {
                $post->image = $imageName;
            };
            $post->user_id = Auth::user()->id;
            $post->description = $request->description;
            $post->publish_at = Carbon::now();
            $post->created_at = Carbon::now();
            
        $post->save();


        $post->post_tag()->attach($request->tags);
        
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
        
        return view('admin.post_view', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags= Tag::all();
        $categorys= Category::all();
        return view('admin.post_edit', compact(['post', 'categorys', 'tags']));
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
        $id= $post->id;
        $request->validate([
            'title'=>'required|unique:posts,title,'.$id,
            'category'=>'required',
            'image'=> 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        if (isset($request->image)) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/post'), $imageName);


            $image_path = "images/post/".$post->image;

            if (File::exists($image_path)) {
                File::delete($image_path);
                //unlink($image_path);
            }
        }
        
            $post->post_tag()->sync($request->tags);

            $post->title = $request->title;
            $post->category_id = $request->category;
            if (isset($request->image)) {
                $post->image = $imageName;
            };
            $post->description = $request->description;
            $post->updated_at = Carbon::now();
            
            $post->save();


            



        // $post->update([
        //     'title'=> $request->title,
        //     'category_id'=> $request->category,
        //     'image'=> $request->image,
        //     'description'=> $request->description,
        // ]);
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
            $post->post_tag()->detach();
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
