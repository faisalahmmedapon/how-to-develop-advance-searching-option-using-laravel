@extends('backend.layouts.index')

@section('title')
     | Post Details
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 col-md-12 col-lg-12 d-flex justify-content-end">
                    <a href="{{route('post.index')}}" class="btn btn-info"> <i class="fa fa-list"> Post Lists </i>  </a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row  py-5">
                <div class="col-12 col-sm-6 col-md-10 col-lg-10 mx-auto">
                    <div class="shadow p-3">
                        <p><strong> <b>Status:</b> </strong> @if($post->status == 1) <a class="btn-sm btn-success">Active</a> @else <a class="btn-sm btn-success"> Inactive </a> @endif</p>
                        <p><strong> <b>Category:</b> </strong> <i>{{$category->category_name}}</i></p>
                        <p><strong> <b> SubCategory:</b> </strong> <i>{{$sub_category->sub_category_name}}</i></p>
                        <p><strong> <b> ChildCategory:</b> </strong> <i>{{$child_category->child_category_name}}</i></p>
                        <p><strong> <b> Post Title :</b> </strong> <i>{{$post->post_title}}</i></p>
                        <p><strong> <b> Post Description :</b> </strong> <i>{!! $post->description !!}</i></p>
                        <p><strong> <b> Post Image :</b> </strong> <br> <img class="img-fluid" src="{{$post->post_image}}"></p>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

@endsection
