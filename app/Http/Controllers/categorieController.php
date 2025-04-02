<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class categorieController extends Controller
{
   public function index(){
    $categories = Category::all();
    // return view('front.Categories.index',compact('categories')); laravel 10
    return view('front.Categories.index',['categories' => $categories]);
   }
   public function show($id){
    $category=Category::findOrFail($id);
    return view('front.Categories.index',[
        'category'=>$category,
    ]);
   }
}
