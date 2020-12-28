<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Category;
use App\Comment;
use Illuminate\Http\Request;
use DB;

class Projectcontroller extends Controller
{
    public function index()
    {
         $blogs = Blog::where('publication_status', 1)
                     ->orderBy('id','desc')
                     ->get();
         $categories = Category::where('publication_status',1)->get();
        return view('front.home.home', [
            'blogs' => $blogs,
            'categories' => $categories,
            'popularBlogs' => Blog::orderBy('hit_count','desc')->get(),
        ]);

    }
    public function categoryBlog($id) {
        $categories = Category::where('publication_status',1)->get();
        $blogs      = Blog::where('category_id',$id)->where('publication_status',1)->get();
        return view('front.category.category-blog',[
            'categories' => $categories,
            'blogs'      => $blogs
        ]);

    }
    public function blogDetails($id){
        $blog       = Blog::find($id);
        $blog->hit_count = $blog->hit_count+1;
        $blog->save();
        $categories = Category::where('publication_status',1)->get();
        return view('front.blog.blog-details',[
            'categories' => $categories,
            'blog'       => Blog::find($id),
            'comments'   => DB::table('comments')
                              ->join('visitors','comments.visitor_id','=','visitors.id')
                              ->select('comments.*','visitors.first_name','visitors.last_name')
                              ->where('comments.blog_id',$id)
                              ->where('comments.publication_status',1)
                              ->orderBy('comments.id','desc')
                              ->get(),

        ]);
    }

}
