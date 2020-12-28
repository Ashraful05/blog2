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
            <form action="{{route('new-category')}}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <br>
                    <label class="control-label col-md-3">Category Name</label>
                    <div class="col-md-9">
                        <input type="text" name="category_name" class="form-control" >
                        <span class="text-danger">{{ $errors->has('category_name') ? $errors->first('category_name') : ' ' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <br>
                    <label class="control-label col-md-3">Category Description</label>
                    <div class="col-md-9">
                        <textarea name="category_description" id=""  class="form-control"></textarea>
                        <span class="text-danger">{{ $errors->has('category_description') ? $errors->first('category_description') : ' ' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <br>
                    <label class="control-label col-md-3">Publication Status</label>
                    <div class="col-md-9">
                        <label><input type="radio" name="publication_status" value="1" >Published</label>
                        <label><input type="radio" name="publication_status" value="0">Unpublished</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                        <input type="submit" name="btn" class="btn btn-success btn-block" value="Save Cagtegory Info">
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection
