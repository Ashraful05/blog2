@extends('admin.master')
@section('title')
    Add Category
@endsection

@section('body')
    <div class="row">
        <div class="col-md-12">
            <br>
            <div class="well">
                <h2 class="text-center text-success">{{Session::get('message')}}</h2>
                <form action="{{route('update-category')}}" method="post" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <br>
                        <label class="control-label col-md-3">Category Name</label>
                        <div class="col-md-9">
                            <input type="text" name="category_name" value="{{$category->category_name}}" class="form-control">
                            <input type="hidden" name="id" value="{{$category->id}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <br>
                        <label class="control-label col-md-3">Category Description</label>
                        <div class="col-md-9">
                            <textarea  name="category_description" id="" cols="10" rows="5" class="form-control">{{$category->category_description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <br>
                        <label class="control-label col-md-3">Publication Status</label>
                        <div class="col-md-9">
                            <label><input type="radio" {{$category->publication_status == 1 ? 'checked':''}} name="publication_status" value="1" >Published</label>
                            <label><input type="radio" {{$category->publication_status == 0 ? 'checked':''}} name="publication_status" value="0">Unpublished</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <input type="submit" name="btn" class="btn btn-success btn-block" value="Update Cagtegory Info">
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

