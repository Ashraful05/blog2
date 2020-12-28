<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Blog;

class Category extends Model
{
    protected $fillable = ['category_name','category_description','publication_status'];

    public static function saveCategory($request)
    {
        $category = new Category();
        $category->category_name        = $request->category_name;
        $category->category_description = $request->category_description;
        $category->publication_status   = $request->publication_status;
        $category->save();
    }
    public static function updateCategory($request)
    {
        $unpublishedBlog = '';
        $category = Category::find($request->id);
        $category->category_name        = $request->category_name;
        $category->category_description = $request->category_description;
        $category->publication_status   = $request->publication_status;
        if($category->publication_status == '0')
        {
          $blogs = Blog::where('category_id', $category->id)
                       ->where('publication_status',1)->get();

          foreach ($blogs as $blog) {
              # code...
              $blog->publication_status = 2;
              $blogs->save();
          }
        }
        else if($category->publication_status == '1'){
//            $unpublishedBlog = Blog::where('category_id', $category->id)
//                                   ->where('publication_status',0)->get();

            $blogs = Blog::where('category_id', $category->id)
                         ->where('publication_status',2)->get();
                    foreach ($blogs as $blog) {
                        # code...
                        $blog->publication_status = 1;
                        $blogs->save();
                    }
        }
        $category->save();
    }
}
