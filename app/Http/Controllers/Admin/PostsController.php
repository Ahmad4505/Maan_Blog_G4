<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Scopes\PublishedScope;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $posts = Post::all();
        // $posts = Post::withoutGlobalScope('published')
        $posts = Post::withoutGlobalScope(PublishedScope::class)
        ->leftJoin('categories','categories.id','=','posts.category_id')
        ->select([
            'posts.*',
            'categories.name as category_name'
        ])
        ->orderBy('created_at','DESC')
        // ->latest() //the same of the ==>oederBy by defult use the colome created_at
        ->paginate();
        return view('admin.posts.index', [
            'posts' => $posts,
            'total_posts'=>Post::count(), // return int of the number of posts (index postsفي ملف alart يوجد الها )
        ]);
    }

    public function __construct()//??
    {
        $this->middleware(['auth']);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       if(!Gate::allows('posts.create')){
        abort(403);
       }

    //    if(Gate::denies('posts.create')){
    //     abort(403);
    //    }
        return view('admin.posts.create', [
            'post' => new Post(),
            'categories' => Category::all(),
            'tags'=>Tag::all(),
            'post_tags'=>[],//عشان بحاله الكريت بتكون فاضيه وهطلع ايرور
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    // public function store(Request $request)
    {
        if(!Gate::allows('posts.create')){
            abort(403);
           }
        // $file->getClientOriginalName();//name the file
        // $file->getClientOriginalExtension();//'jpg
        // $file->getSize();//size
        // $file->getMineType();//image/jpeg,image/png

        // $request->validate($this->rules());
        $image_path = null; //في حاله انه م دخل علي البلوك
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) { //عشان اتاكد انه الملف مرفوع بدون مشاكل
                // $image_path = $file->store('uploads');  //لتخزين الملف من مؤقت الي دائم
                //  $image_path=$file->storePublicly('uploads') ;  //لتخزين الملف من مؤقت الي دائم
                // $image_path = $file->storePublicly('uploads' , [
                //     'disk' => 'uploads',
                // ]);
                $image_path = $file->storePublicly('uploads' , [
                    'disk' => 'public',
                ]);
            }
        }
        $post = Post::create([
            'title' => $request->post('title'),
            // 'slug' => Str::slug($request->post('title')),
            'category_id' => $request->post('category_id'),
            'content' => $request->post('content'),
            'image' => $image_path,
            'status' => $request->post('status'),
            'user_id'=>Auth::user()->id,//Auth::id() //$request->user()->id
        ]);
        $post->tags()->attach($request->post('tag'));//هتعبي بالجدول الوسيط العلاقه مابين جدول البوست والتاق

        return redirect()->route('admin.posts.index')->with('success', 'Post created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', [
            'post' => $post,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!Gate::allows('posts.update')){
            abort(403);
           }
        $post = Post::withTrashed()->withoutGlobalScope('published')->findOrFail($id);
        $post_tags=$post->tags()->pluck('id')->toArray();
        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => Category::all(),
            'tags'=>Tag::all(),
            'post_tags'=>$post_tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    // public function update(Request $request, string $id)
    {
        if(!Gate::allows('posts.update')){
            abort(403);
           }

        // $request->validate($this->rules());
        $post = Post::withoutGlobalScope('published')->findOrFail($id);
        $image_path = null;
        $old_image=$post->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                // $image_path = $file->store('uploads');  //لتخزين الملف من مؤقت الي دائم
                // $image_path = $file->storePublicly('uploads');
                $image_path = $file->storePublicly('uploaads' , [
                    'disk' => 'public',
                ]); //store in uploades folder in app in storage
                // $image_path = $file->storePublicly('uploaads' , [
                //     'disk' => 'uploads',
                // ]); //store in uploades folder in app in storage
            }
        }
        $post->update([
            'title' => $request->post('title'),
            // 'slug' => Str::slug($request->post('title')),
            'content' => $request->post('content'),
            'category_id' => $request->post('category_id'),
            'image' => $image_path? $image_path :$post->image,
        ]);
        if($image_path && !empty($old_image)){
            Storage::disk('uploads')->delete($old_image);
        }
        $post->tags()->sync($request->post('tag'));//هتعبي بالجدول الوسيط العلاقه مابين جدول البوست والتاق
        // $post->tags()->attach($request->post('tag'));//هتعبي بالجدول الوسيط العلاقه مابين جدول البوست والتاق
        return redirect()->route('admin.posts.index')->with('success', 'Post updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!Gate::allows('posts.delete')){
            abort(403);
           }
        // Post::destroy($id);
        $post=Post::withoutGlobalScope('published')->findOrFail($id);
        $post->delete();
        // if($post->image){
        //     Storage::disk('uploads')->delete($post->image);
        // }
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted');
    }
    public function download($id)
    {
        $post=Post::findOrFail($id);
        if(!$post->image){
            abort(404);
        }
        // return response()->download(storage_path('app/public/'.$post->image));
        return response()->file(storage_path('app/public/'.$post->image));
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|int|exists:categories,id',
            'content' => 'required',
            'image' => 'image|max:409600'   // 400 * 1024
        ];
    }
    //page of the create data and restore and delete
    public function trash(){
        $posts=Post::onlyTrashed()->paginate();
        return view('admin.posts.trash',[
            'posts'=>$posts,
        ]);
    }
    // restore the data in table
    public function restore($id){
        $post=Post::onlyTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('admin.posts.index')->with('success', 'Post restored');

    }
    // حذف نهائي للبوست
    public function forceDelete($id){
        $post=Post::withTrashed()->findOrFail($id);
        $post->forceDelete();
         // if($post->image){
        //     Storage::disk('uploads')->delete($post->image);
        // }
        return redirect()->route('admin.posts.index')->with('success', 'Post force Delete');

    }
}
