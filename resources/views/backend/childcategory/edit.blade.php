@extends('backend.layouts.index')


@section('title')
     | Child Category Edit
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 col-md-12 col-lg-12 d-flex justify-content-end">
                    <a href="{{route('childcategory.index')}}" class="btn btn-info"> <i class="fa fa-list"> Child Category Lists </i>  </a>
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
                <div class="col-12 col-sm-6 col-md-8 mx-auto">
                    <div class="shadow p-3">
                        <form action="{{route('childcategory.update',$child_category->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="category_name"> Category Name: </label>
                                <select class="form-select form-control" aria-label="Post Category" name="category_id">
                                    <option readonly disabled >Open this select menu</option>
                                    @foreach($categories as $category)
                                        <option @if($child_category->category_id == $category->id) selected @endif  value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="category_name"> Sub Category Name: </label>
                                <select class="form-select form-control" aria-label="Post Category" name="sub_category_id">
                                    <option readonly disabled >Open this select menu</option>
                                    @foreach($sub_categories as $sub_category)
                                        <option  value="{{$sub_category->id}}">{{$sub_category->sub_category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="child_category_name"> Child Category Name: </label>
                                <input type="text" name="child_category_name" class="form-control" value="{{$child_category->child_category_name}}" id="child_category_name">
                                <div style='color:red; padding: 0 5px;'>{{($errors->has('child_category_name'))?($errors->first('child_category_name')):''}}</div>
                            </div>

                            <div class="form-group">
                                <label for="noImage"> Child Category Logo: </label>
                                <img  class="float-right"  style="padding:4px;border:1px solid #ddd; margin: 10px 0; width:300px;height: 200px" id="showNoImage" src="@if($child_category->child_category_logo){{asset($child_category->child_category_logo)}}@else{{asset('defaults/noimage/no_img.jpg')}}@endif" alt="image">
                                <input type="file" name="child_category_logo" class="form-control" id="noImage">
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
