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
                            <th>Blog Title</th>
                            <th>Visitor Name</th>
                            <th>Comment</th>
                            <th>Publication Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($comments  as $comment)
                            <tr class="odd gradeX">
                                <td>{{$i++}}</td>
                                <td>{{$comment->blog_title}}</td>
                                <td>{{$comment->first_name.' '.$comment->last_name}}</td>
                                <td>{{$comment->comment}}</td>
                                <td>{{$comment->publication_status == 1 ? 'Published':'Unpublished'}}</td>
                                <td>
                                    @if($comment->publication_status == 1)
                                        <a href="{{ route('unpublished-comment',['id'=>$comment->id]) }}">Unpublished</a>
                                    @else
                                        <a href="{{ route('published-comment',['id'=>$comment->id]) }}">Published</a>
                                    @endif
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
