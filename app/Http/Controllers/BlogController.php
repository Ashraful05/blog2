<?php

namespace App\Http\Controllers;

use App\Category;
use App\Blog;
use App\Comment;
use Illuminate\Http\Request;
use DB;

class BlogController extends Controller
{
    public function addBlog()
    {
        $categories = Category::where('publication_status',1)->get();
//        return $categories;
        return view('admin.blog.add-blog',[
            'categories'=>$categories
        ]);
    }
    public function newBlog(Request $request)
    {
//        return $request->all();
        $image     = $request->file('blog_image');
        $imageName = $image->getClientOriginalName();
        $directory = './blog-images/';
        $image->move($directory,$imageName);

        $blog = new Blog();
        $blog->category_id            = $request->category_id;
        $blog->blog_title             = $request->blog_title;
        $blog->blog_short_description = $request->blog_short_description;
        $blog->blog_long_description  = $request->blog_long_description;
        $blog->blog_image             = $directory.$imageName;
        $blog->publication_status     = $request->publication_status;
        $blog->save();

        return redirect('blog/add-blog')->with('message','Blog Info Saved Successfully');

//        return 'success';

//        return $image;
    }
    public function manageBlog()
    {
        $blogs = DB::table('blogs')
                     ->join('categories', 'blogs.category_id', '=', 'categories.id')
                     ->select('blogs.*', 'categories.category_name')
                     ->orderBy('blogs.id','desc')
                     ->get();

//        $blogs = Blog::all();
//        return $blogs;
        return view('admin.blog.manage-blog',[
            'blogs' => $blogs
        ]);
    }

    public function editBlog($id)
    {
       $categories = Category::where('publication_status',1)->get();
       $blog      = Blog::find($id);
        return view('admin.blog.edit-blog',[
            'categories' =>$categories,
            'blog'      =>$blog
        ]);
    }

    public function updateBlog(Request $request)
    {
        $blogImage = $request->file('blog_image');
        $blog = Blog::find($request->id);
        if($blogImage){
            if(file_exists($blog->blog_image)) {
                unlink($blog->blog_image);
            }

//           $image     = $request->file('blog_image');
            $imageName = $blogImage->getClientOriginalName();
            $directory = './blog-images/';
            $blogImage->move($directory,$imageName);
//            return redirect('/blog/manage-blog')->with('message','Blog Info Updated successfully');

        }
//            $blog = Blog::find($request->id);
//            unlink($blog->blog_image);
//
////            $image     = $request->file('blog_image');
//            $imageName = $blogImage->getClientOriginalName();
//            $directory = './blog-images/';
//            $blogImage->move($directory,$imageName);

//            $blog->category_id            = $request->category_id;
//            $blog->blog_title             = $request->blog_title;
//            $blog->blog_short_description = $request->blog_short_description;
//            $blog->blog_long_description  = $request->blog_long_description;
//            $blog->publication_status     = $request->publication_status;
//            $blog->save();
        $blog->category_id            = $request->category_id;
        $blog->blog_title             = $request->blog_title;
        $blog->blog_short_description = $request->blog_short_description;
        $blog->blog_long_description  = $request->blog_long_description;
        $blog->blog_image             = $directory.$imageName;
        $blog->publication_status     = $request->publication_status;
        $blog->save();
        return redirect('/blog/manage-blog')->with('message','Blog Info Updated successfully');
    }
    public function deleteBlog(Request $request)
    {
         $blog = Blog::find($request->id);

         if(file_exists($blog->blog_image))
         {
            unlink($blog->blog_image);
         }

         $blog->delete();

        return redirect('/blog/manage-blog')->with('message','Blog Info Deleted successfully');

    }
    public function manageComment() {
        return view('admin.comment.manage-comment',[
            'comments'   => DB::table('comments')
                        ->join('visitors','comments.visitor_id','=','visitors.id')
                        ->join('blogs','comments.blog_id','=','blogs.id')
                        ->select('comments.*','visitors.first_name','visitors.last_name','blogs.blog_title')
                        ->orderBy('comments.id','desc')
                        ->get()
        ]);

    }

    public function publishedComment($id){
        $comment = Comment::find($id);
        $comment->publication_status=1;
        $comment->save();
        return redirect('/manage-comments');
    }

    public function unpublishedComment($id){
        $comment = Comment::find($id);
        $comment->publication_status=0;
        $comment->save();
        return redirect('/manage-comments');
    }
}
