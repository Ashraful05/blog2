<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Blog;
use DB;

class CategoryController extends Controller
{
    public function addCategory()
    {
        return view('admin.category.add-category');
    }
    protected function checkCategoryData($request){
        $this->validate($request,[
            'category_name' => 'required|regex:/(^([a-zA-Z_ ]+)(\d+)?$)/u|max:20|min:5',
            'category_description' => 'required|max:100'
        ]);
    }
    public function saveCategory(Request $request)
    {
        //return $request->all();

//        $category=new Category();
//        $category->saveCategory($request);
        $this->checkCategoryData($request);
        Category::saveCategory($request);
        return redirect('category/add-category')->with('message','Category Info added successfully');
    }
    public function manageCategory()
    {
        $categories = Category::all();
        return view('admin.category.manage-category',[
            'categories' => $categories
        ]);
    }
    public function editCategory($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit-category',[
            'category'=>$category
        ]);
    }
    public function updateCategory(Request $request)
    {

        Category::updateCategory($request);
        return redirect('/category/manage-category')->with('message','Category Info Updated Successfully');
    }
    public function deleteCategory(Request $request)
    {
        $blog = Blog::where('category_id',$request->id)->first();

        if($blog){
            return redirect('/category/manage-category')->with('message','We Can not delete this category');
        }
        else{
            $category=Category::find($request->id);
            $category->delete();
            return redirect('/category/manage-category')->with('message','Category Info deleted Successfully');
        }



    }
}
