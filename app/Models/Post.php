<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Category;



class Post extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'image', 
        'description', 
        'category_id',
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
    public function post_tag(){
        return $this->belongsToMany('App\Models\Tag');
    }
}
