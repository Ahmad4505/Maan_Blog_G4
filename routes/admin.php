<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\categorieController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Middleware\ChekUserType;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => '/admin',
    'as' => 'admin.',
    'middleware'=>['auth','user.type:admin,super-admin']//user.type=>> alias calss
    // 'middleware'=>['auth:editor,web','user.type:admin,super-admin']//user.type=>> alias calss
    // 'middleware'=>['auth',ChekUserType::class]
], function () {
    Route::group([
        'prefix' => 'categories',
        'as' => 'categories.',
    ], function () {
        Route::get('/', [CategoriesController::class, 'index'])->name('index');
        Route::get('/create', [CategoriesController::class, 'create'])->name('create');
        Route::post('/', [CategoriesController::class, 'store'])->name('store');
        Route::get('/{id}', [CategoriesController::class, 'edit'])->name('edit');
        Route::put('/{id}', [CategoriesController::class, 'update'])->name('update');
        Route::delete('/{id}', [CategoriesController::class, 'destroy'])->name('destroy');
    });
    Route::get('/posts/trash',[PostsController::class, 'trash'])->name('posts.trash');
    Route::put('/posts/{id}/restore',[PostsController::class, 'restore'])->name('posts.restore');
    Route::delete('/posts/{id}/forceDelete',[PostsController::class, 'forceDelete'])->name('posts.forceDelete');
    Route::get('/posts/{id}/download',[PostsController::class, 'download'])->name('posts.download');

    Route::group([
        'prefix' => 'posts',
        'as' => 'posts.',
    ], function () {
        Route::get('/', [PostsController::class, 'index'])->name('index');
        Route::get('/create', [PostsController::class, 'create'])->name('create');
        Route::post('/', [PostsController::class, 'store'])->name('store');
        Route::get('/{id}', [PostsController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PostsController::class, 'update'])->name('update');
        Route::delete('/{id}', [PostsController::class, 'destroy'])->name('destroy');
    });

});
Route::get('/posts',[PostController::class,'index'])->name('posts');
Route::get('/posts/{id}',[PostController::class,'show'])->name('posts.show');

Route::get('/categories',[categorieController::class,'index'])->name('categories');
Route::get('/categories/{id}',[categorieController::class,'show'])->name('show');

// Route::get('/welcome_page_controller', 'App\Http\Controllers\HomeController@welcome'); //old way
// Route::get('/welcome_page_controller',[App\Http\Controllers\HomeController::class, 'welcome']);

Route::get('/welcome_page_controller',[HomeController::class, 'welcome']);  //new way => array(first parameter: class name (controller), second parameter: function name in controller)

Route::get('/hello',[HomeController::class, 'hello']);

Route::get('/news',[HomeController::class, 'news']);

// Route::get('/news/2',[HomeController::class, 'news']);
Route::get('/news/{id}',[HomeController::class, 'view']); //route parameter (variable)
Route::get('/news2/{id}/{id2}',[HomeController::class, 'view']);

/*
Http Request methods :
Get
Post
Put => update single resourse
Patch => update multiple resourses
Delete
*/

// Route::get();
// Route::post();
// Route::put();
// Route::patch();
// Route::delete();


//First Way :

// Route::get('admin/categories', 'Admin\CategoriesController@index'); //(old way)
// Route::get('admin/categories',[Admin\CategoriesController::class, 'index'])->name('admin.categories.index');
// Route::get('admin/categories/create',[Admin\CategoriesController::class, 'create'])->name('admin.categories.create');
// Route::post('admin/categories',[Admin\CategoriesController::class, 'store'])->name('admin.categories.store');
// Route::get('admin/categories/{id}',[Admin\CategoriesController::class, 'edit'])->name('admin.categories.edit');
// Route::put('admin/categories/{id}',[Admin\CategoriesController::class, 'update'])->name('admin.categories.update');
// Route::delete('admin/categories/{id}',[Admin\CategoriesController::class, 'destroy'])->name('admin.categories.destroy');


//Second Way => (Resourse Routes):

//Categories Routes :
// Route::group([
//     'prefix' => 'admin/categories',
//     'namespace' => 'Admin',
//     'as' => 'admin.categories.',

// ], function(){

//     Route::get('/', [CategoriesController::class, 'index'])->name('index');
//     Route::get('/create', [CategoriesController::class, 'create'])->name('create');
//     Route::post('/', [CategoriesController::class, 'store'])->name('store');
//     Route::get('/{id}', [CategoriesController::class, 'edit'])->name('edit');
//     Route::put('/{id}', [CategoriesController::class, 'update'])->name('update');
//     Route::delete('/{id}', [CategoriesController::class, 'destroy'])->name('destroy');

// });


// //Posts Routes :
// Route::group([
//     'prefix' => 'admin/posts',
//     'namespace' => 'Admin',
//     'as' => 'admin.posts.',

// ], function(){

//     Route::get('/', [PostsController::class, 'index'])->name('index');
//     Route::get('/create', [PostsController::class, 'create'])->name('create');
//     Route::post('/', [PostsController::class, 'store'])->name('store');
//     Route::get('/{id}', [PostsController::class, 'edit'])->name('edit');
//     Route::put('/{id}', [PostsController::class, 'update'])->name('update');
//     Route::delete('/{id}', [PostsController::class, 'destroy'])->name('destroy');

// });




//   Route::resource('/admin/posts','Admin\PostsController')
//     ->except('show')
//     ->names([
//         'index'=>'list',
//     ]);
