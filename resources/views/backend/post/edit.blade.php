@extends('backend.layouts.index')

@section('title')
    | Post Edit
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
                        <form action="{{route('post.update',$post->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="category_name"> Category: </label>
                                <select class="form-select form-control" aria-label="Post Category" name="category_id">
                                    <option readonly disabled >Open this select menu</option>
                                    @foreach($categories as $category)
                                        <option @if($post->category_id == $category->id) selected @endif value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="category_name"> Sub Category Name: </label>
                                <select class="form-select form-control" aria-label="Post Category" name="sub_category_id">
                                    <option readonly disabled >Open this select menu</option>
                                    @foreach($sub_categories as $sub_category)
                                        <option @if($post->sub_category_id == $sub_category->id) selected @endif   value="{{$sub_category->id}}">{{$sub_category->sub_category_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="category_name"> Child Category Name: </label>
                                <select class="form-select form-control" aria-label="Post Category" name="child_category_id">
                                    <option readonly disabled >Open this select menu</option>
                                    @foreach($child_categories as $child_category)
                                        <option @if($post->child_category_id == $child_category->id) selected @endif   value="{{$child_category->id}}">{{$child_category->child_category_name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="noImage"> Category Logo: </label>
                                <input type="file" name="post_image" class="form-control" id="noImage">
                                <img  class="float-right"  style="padding:4px;border:1px solid #ddd; margin: 10px 0; width:300px;height: 200px" id="showNoImage" src="@if($post->post_image){{asset($post->post_image)}}@else{{asset('defaults/noimage/no_img.jpg')}}@endif" alt="image">
                            </div>


                            <div class="form-group">
                                <label for="post_title"> Post Title: </label>
                                <input type="text" name="post_title" class="form-control" value="{{$post->post_title}}" id="post_title">
                                <div style='color:red; padding: 0 5px;'>{{($errors->has('post_title'))?($errors->first('post_title')):''}}</div>
                            </div>


                            <div class="form-group">
                                <label for="description"> Description: </label>
                                <textarea  name="description" class="form-control summernote"  id="description"> {{$post->description}}  </textarea>
                                <div style='color:red; padding: 0 5px;'>{{($errors->has('description'))?($errors->first('description')):''}}</div>
                            </div>

                            <button type="submit" class="btn btn-success"> <i class="fa ">Submit</i> </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

@endsection
