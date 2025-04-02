<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        // $posts=Post::where('status','=','published')->paginate();
        // $posts=Post::paginate();
        // Eager loading
        // SELECT* FROM posts
        // SELECT* FROM categories WHERE id IN (1,2,3)
        $posts=Post::with('category')->paginate(); //بداخل الويدث بحط اسم الريليشن الي بدي احملها مسبقا
        // $posts=Post::status('draft')->paginate();
        // $posts=Post::published()->paginate();
        // $posts=Post::Draft()->paginate();
        // $posts=Post::query()->dd();
        // return view('posts.index',compact('posts'));
        return view('front.posts.index',[
            'posts'=>$posts,
        ]);
    }
    public function show($id){
        // $post=Post::where('status','=','published')->findOrFail($id);
        // $post=Post::published()->findOrFail($id);
        $post=Post::findOrFail($id);
        // $post=Post::status('draft')->findOrFail($id);
        return view('front.posts.show',[
            'post'=>$post,
        ]);
    }
}
