<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $abilities=[
        'posts.create'=>'can create new post',
        'posts.update'=>'can update new post',
        'posts.delete'=>'can delete post',
        'categories.create'=>'can create new category',
        'categories.update'=>'can update new category',
        'categories.delete'=>'can delete category',

    ];
    public function run(): void
    {
        foreach($this->abilities as $code=>$name){
            DB::table('abilities')->insert([
                'code'=>$code,
                'name'=>$name
               ]);
        }
    //    DB::table('abilities')->insert([
    //     'code'=>'posts.create',
    //     'name'=>'can create new post'
    //    ]);
    //    DB::table('abilities')->insert([
    //     'code'=>'posts.update',
    //     'name'=>'can update new post'
    //    ]);
    }
}
