@extends('admin.master')
@section('title')
    Manage Blog
@endsection

@section('body')
    <br>
    {{--    <div id="page-wrapper">--}}
    {{--        <div class="row">--}}
    {{--            <div class="col-lg-12">--}}
    {{--                <h1 class="page-header">Tables</h1>--}}
    {{--            </div>--}}
    {{--            <!-- /.col-lg-12 -->--}}
    {{--        </div>--}}
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    DataTables Advanced Tables
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <h3 class="text-center text-success">{{Session::get('message')}}</h3>
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Category Name</th>
                            <th>Blog Title</th>
                            <th>Blog Image</th>
                            <th>Publication Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($blogs as $blog)
                            <tr class="odd gradeX">
                                <td>{{$i++}}</td>
                                <td>{{$blog->category_name}}</td>
                                <td>{{$blog->blog_title}}</td>
                                <td><img src="{{ asset($blog->blog_image) }}" alt="" width="120" height="80"></td>
                                <td>{{$blog->publication_status == 1 ? 'Published':'Unpublished'}}</td>
                                <td>
                                    <a href="{{ route('edit-blog', ['id'=>$blog->id] )}}">Edit</a>
                                    <a href="" id="{{ $blog->id }}" onclick="
                                        event.preventDefault();
                                        // var categoryId=$(this).attr('id');
                                        var check = confirm('Are you sure to delete?');
                                        if(check){
                                        document.getElementById('deleteBlogForm' + '{{$blog->id}}' ).submit();
                                        }">Delete</a>

                                    <form id="deleteBlogForm{{ $blog->id }} " action="{{route('delete-blog')}}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{$blog->id}}" name="id">
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    </div>
@endsection

