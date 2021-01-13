<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FontendController extends Controller
{
    public function index(){
        $posts= Post::all();
        $recent_posts= Post::with("post_tag")-> orderBy('id', 'desc')->paginate(9);
        $top_post= post::with(["post_tag", "user"])->where('category_id', 5)-> orderBy('id', 'desc')->take(5)->get();
        
        $home_top_left = $top_post->slice(1, 2);
        $home_top_mid = $top_post->slice(0, 1);
        $home_top_right = $top_post->slice(3, 2);



        
        return view('public.home', compact(['posts', 'recent_posts', 'home_top_left', 'home_top_mid', 'home_top_right']));
    }

    public function single($id){

        $single_post=Post::with(["post_tag", "user", "category"])->find($id);

        return view('public.single',compact('single_post'));

    }

    
}
