@extends('admin.master')
@section('title')
    Edit Blog
@endsection

@section('body')
    <div class="row">
        <div class="col-md-12">
            <br>
            <div class="well">
                <h3 class="text-success text-center">Edit Blog Form
                    <hr/>
                </h3>
                <h2 class="text-center text-success">{{Session::get('message')}}</h2>
                <form action="{{route('update-blog')}}" method="post" class="form-horizontal"
                      enctype="multipart/form-data" name="editBlogForm">
                    @csrf
                    <div class="form-group">
                        <br>
                        <label class="control-label col-md-3">Category Name</label>
                        <div class="col-md-9">
                            <select name="category_id" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <br>
                        <label class="control-label col-md-3">Blog Title</label>
                        <div class="col-md-9">
                            <input type="text" name="blog_title" value="{{$blog->blog_title}}" class="form-control">
                            <input type="hidden" value="{{$blog->id}}" name="id" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <br>
                        <label class="control-label col-md-3">Blog Short Description</label>
                        <div class="col-md-9">
                            <textarea name="blog_short_description"
                                      class="form-control">{{$blog->blog_short_description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <br>
                        <label class="control-label col-md-3">Blog Long Description</label>
                        <div class="col-md-9">
                            <textarea name="blog_long_description" id="editor" cols="10" rows="5"
                                      class="form-control">{{$blog->blog_long_description}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <br>
                        <label class="control-label col-md-3">Blog Image</label>
                        <div class="col-md-9">
                            <input type="file" name="blog_image" accept="image/*">
                            <br>
                            <img src="{{asset($blog->blog_image)}}" height="80" width="100" alt="">
                        </div>
                    </div>

                    <div class="form-group">
                        <br>
                        <label class="control-label col-md-3">Publication Status</label>
                        <div class="col-md-9">
                            <label><input type="radio"
                                          {{$blog->publication_status == 1 ?'checked':'' }} name="publication_status"
                                          value="1">Published</label>
                            <label><input type="radio"
                                          {{$blog->publication_status == 0 ?'checked':'' }} name="publication_status"
                                          value="0">Unpublished</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <input type="submit" name="btn" class="btn btn-success btn-block" value="Update Blog Info">
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.forms['editBlogForm'].elements['category_id'].value = ' {{$blog->category_id}} ';
    </script>

@endsection

