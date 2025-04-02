<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
// use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    //function to show all Categories:
    public function index()
    {
        //$categories array of category model
        //Collection (imagine as array):
        // $categories = Category::all();
      /*  $categories = Category::leftJoin('categories as parent','parent.id','=','categories.parent_id')
        ->select([
            'categories.*',
            'parent.name as parent_name',
            // 'SELECT COUNT(*) FROM posts WHERE posts.category_id = categories.id' //row statments
            DB::raw('(SELECT COUNT(*) FROM posts WHERE posts.category_id = categories.id) as products_count')
        ])
        // ->selectRaw('(SELECT COUNT(*) FROM posts WHERE posts.category_id = categories.id) as products_count')
        // ->simplepaginate(3);
        ->orderBy('name','ASC')
        ->paginate(5);*/
        //collection => as array
        // $categories = Category::where('id', '=', 3)->get();
        // $categories = Category::where('name', 'Like', '%pink%')->get();


        //egare loading of the relation parent
        $categories=Category::with('parent')->withCount('posts')->orderBy('name','ASC')->paginate(5); //the same of the leftjoin
        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }
    // return view('admin.categories.index',['categories'=> $categories]); //laravel 8
    // return view('admin.categories.index',compact('categories')); //laravel 10
    public function create()
    {
        $parent_categories = Category::all();
        return view('admin.categories.create', [
            'parent_categories' => $parent_categories,
            'category' => new Category(),

        ]);
    }


    //store categories method :
    public function store(Request $request)
    {

        // $request->name;
        // $request->get('name');
        // $request->input('name', 'Default Value');
        // $request->post('name', 'Default Value');
        // $request->query('name');
        // dd($request->post('name')); // stop the code and print information

        // dd($request->all());
        // dd($request->only('name', '_token'));
        // dd($request->except('_token'));

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:3|unique:categories,name',
            'parent_id' => 'nullable|int|exists:categories,id',
        ]);

        //  if($validator->fails()) {
        //     // dd($validator->failed());
        //     dd($validator->errors());
        //  }

        $validator->validate();


        $category = new Category();
        $category->name = $request->post('name');
        $category->slug = Str::slug($request->post('name'));
        $category->parent_id = $request->post('parent_id');

        // to save data in database:
        $category->save();


        //return user to index page (after (save) respose): *** PRG -> post redirect get ***
        // return redirect(route('admin.categories.index'))->with('success','Category created!'); //index action
        return redirect()
            ->route('admin.categories.index')
            ->with('success','Category created!');

    }

    //edit categories method :
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        // $category = Category::find($id);
        // if($category == null){
        //     abort(404);
        // }

        //(find) => SELECT * from categories WHERE id = $id;
        $parent_categories = Category::where('id', '<>', $id)->get();
        // dd($category);
        return view('admin.categories.edit', [
            'category' => $category,
            'parent_categories' => $parent_categories,
        ]);
    }

    //update categories method :
    public function update(Request $request, $id)
    {

        $category = Category::find($id);
        if($category == null){
            abort(404);
        }

        $request->validate([
                'name' => 'required|string|max:255|min:3|unique:categories,name,' . $id,
                'parent_id' => 'nullable|int|exists:categories,id',

 /////////////////////////////////////////////////////////////////////////////////
            // 'name' => [
            //     'required',
            //     'string',
            //     'max:255',
            //     '|min:3',
            //     // (new Unique('categories', 'name'))->ignore($id),
            //     Rule::unique('categories', 'name')->ignore($id),
            // ],
        //     'parent_id' => 'nullable|int|exists:categories,id',


        ]);



            //  if($validator->fails()) {
            //     // dd($validator->failed());
            //     dd($validator->errors());
            //  }


        $category->name = $request->post('name');
        $category->slug = Str::slug($request->post('name'));
        $category->parent_id = $request->post('parent_id');

        // to save data in database:
        $category->save();


        //return user to index page (after (save) respose): *** PRG -> post redirect get ***
        return redirect()
        ->route('admin.categories.index')
        ->with('success','Category updated!'); //index action
    }



    //destroy categories method :
    public function destroy($id)
    {
        //Method 1 (to delete):
        // $category = Category::findOrFail($id);
        // $category->delete();

        //Method 2 (to delete):
        // Category::where('id', '=' , $id)->delete();

        //Method 3 (to delete):
        Category::destroy($id);

        // PRG
        return redirect()
        ->route('admin.categories.index')
        ->with('success','Category deleted!'); //index action

    }

}
