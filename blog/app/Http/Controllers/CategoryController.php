<?php

namespace App\Http\Controllers;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    function __construct()
    {
        $this -> middleware('verified');
    }
    function CategoryList(){
        $categories = Category :: paginate();
        $trash_category = Category :: onlyTrashed()-> paginate(2);
        return view('backend.category.category-list', [
            'categories' => $categories,
            'trash_category' => $trash_category
        ]);
    }
    function CategoryPost(Request $req){
        // Category:: insert([
        //     'category_name' => $req -> category_name,
        //     'created_at' => Carbon :: now()
        // ]);
        
        $req -> validate([
            'category_name' => ['required', 'unique:categories', 'regex:/^[a-zA-Z, \-]*$/']
        ],[
                'category_name.required' => 'Enter any name please'
            ]
        );
        $data = new Category;
        $data -> slug = Str ::slug($req -> category_name);
        $data -> category_name = $req -> category_name;
        $data -> save();
        
        return back() -> with('CategoryAdd', 'Category added Successfully');
        // return redirect(/);
    }

    function CategoryDelete($cat_id){
        Category::findOrFail($cat_id) -> delete();
        return back();
        
    }

    function CategoryRestore($cat_id){
        Category::withTrashed() -> findOrFail($cat_id) -> restore(); 
        return back();
    }

    function CategoryPermanentDelete($cat_id){
        Category::withTrashed() ->findOrFail($cat_id) -> forceDelete();
        return back()->with('PermanentDelete', 'Category Permanently Deleted Successfully');
    }

    function CategoryEdit($id){
        $categories = Category :: paginate();
        $trash_category = Category :: onlyTrashed()-> paginate(2);
        $edit_category = Category :: findOrFail($id);
        
        return view('backend.category.category-edit', [
            'categories' => $categories,
            'trash_category' => $trash_category,
            'edit_category' => $edit_category
        ]);
    }

    function CategoryUpdate(Request $req){
        // Category :: findOrFail($req->id) -> update([
        //     'category_name' => $req->category_name,
        //     'slug' => Str :: slug($req->category_name),
        //     'updated_at' => Carbon:: now()
        // ]);

        $update = Category :: findOrFail($req->id) ;
        $update -> category_name = $req->category_name;
        $update -> slug = $req->category_name;
        $update -> save();
        return back();
    }
}