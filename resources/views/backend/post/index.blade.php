@extends('backend.layouts.index')

@section('title')
    | Posts
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 col-md-12 col-lg-12 d-flex justify-content-end">
                    <a href="{{route('post.create')}}" class="btn btn-success"> <i class="fa fa-plus"> New Post </i> </a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-12">
                    <table class="table table-bordered table-active dataTable">
                        <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col"> Category  </th>
                            <th scope="col"> Sub Category  </th>
                            <th scope="col"> Child Category  </th>
                            <th scope="col"> Title </th>
                            <th scope="col"> Image </th>
{{--                            <th scope="col"> Description </th>--}}
                            <th scope="col"> Action </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($posts as $key=>$post)
                        <tr>
                            <th>{{$key+1}}</th>
                            <td>{{$post->category_name}}</td>
                            <td>{{$post->sub_category_name}}</td>
                            <td>{{$post->child_category_name}}</td>
                            <td>{{Str::limit($post->post_title,60)}}</td>
                            <td><img width="200px" height="100px" src="{{$post->post_image}}"></td>
{{--                            <td>{!! Str::limit($post->description,50) !!}</td>--}}
                            <td>
                                @if($post->status == 1)
                                    <a href="{{route('post.status',$post->id)}}" class="btn"> <i class="fa fa-thumbs-up"> </i> </a>
                                @else
                                    <a href="{{route('post.status',$post->id)}}" class="btn"> <i class="fa fa-thumbs-down"> </i> </a>
                                @endif
                                    <a href="{{route('post.show',$post->id)}}" class="btn"> <i class="fa fa-eye"> </i> </a>
                                    <a href="{{route('post.edit',$post->id)}}" class="btn"> <i class="fa fa-edit"> </i> </a>
                                <a href="{{route('post.delete',$post->id)}}" class="btn"> <i class="fa fa-trash"> </i> </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->

        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

@endsection
