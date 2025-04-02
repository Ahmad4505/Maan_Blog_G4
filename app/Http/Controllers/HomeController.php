<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome(){
        return view('welcome');
    }

    public function hello(){
        return 'Hello from Home Controller';
    }

    public function news(){
        return 'Hello from News Page';
    }

    // function to print the passed id parameter :
    public function view($id){
        return 'News #' . $id;
    }

    // public function view($id = ' '){
    //     return 'News #' . $id;
    // }

    public function view2($id,$id2){
        return 'News #' . $id ." " . $id2;
    }

    // public function view2($id,$id2?){                // the second parameter is optinal
    //     return 'News #' . $id ." " . $id2;
    // }
}
