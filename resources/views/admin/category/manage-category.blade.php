@extends('admin.master')
@section('title')
    Manage Category
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
                                <th>Category Description</th>
                                <th>Publication Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($categories as $category)
                            <tr class="odd gradeX">
                                <td>{{$i++}}</td>
                                <td>{{$category->category_name}}</td>
                                <td>{{$category->category_description}}</td>
                                <td>{{$category->publication_status == 1 ? 'Published':'Unpublished'}}</td>
                                <td>
                                    <a href="{{ route('edit-category', ['id'=>$category->id] )}}">Edit</a>
                                    <a href="" id="{{ $category->id }}" onclick="
                                                event.preventDefault();
                                                // var categoryId=$(this).attr('id');
                                                var check = confirm('Are you sure to delete?');
                                                if(check){
                                                    document.getElementById('deleteCategoryForm' + '{{$category->id}}' ).submit();
                                                }">Delete</a>

                                    <form id="deleteCategoryForm{{ $category->id }} " action="{{route('delete-category')}}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{$category->id}}" name="id">
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
