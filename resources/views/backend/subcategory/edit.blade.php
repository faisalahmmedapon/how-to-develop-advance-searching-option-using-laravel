@extends('backend.layouts.index')

@section('title')
     | Sub Category Edit
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 col-md-12 col-lg-12 d-flex justify-content-end">
                    <a href="{{route('subcategory.index')}}" class="btn btn-info"> <i class="fa fa-list"> Sub Category Lists </i>  </a>
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
                        <form action="{{route('subcategory.update',$subcategory->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="category_name"> Category Name: </label>
                                <select class="form-select form-control" aria-label="Post Category" name="category_id">
                                    <option readonly disabled >Open this select menu</option>
                                    @foreach($categories as $category)
                                        <option @if($subcategory->category_id == $category->id) selected @endif  value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="sub_category_name"> sub Category Name: </label>
                                <input type="text" name="sub_category_name" class="form-control" value="{{$subcategory->sub_category_name}}" id="sub_category_name">
                                <div style='color:red; padding: 0 5px;'>{{($errors->has('sub_category_name'))?($errors->first('sub_category_name')):''}}</div>
                            </div>

                            <div class="form-group">
                                <label for="noImage"> sub Category Logo: </label>
                                <input type="file" name="sub_category_logo" class="form-control" id="noImage">
                                <img  class="float-right"  style="padding:4px;border:1px solid #ddd; margin: 10px 0; width:300px;height: 200px" id="showNoImage" src="@if($subcategory->sub_category_logo){{asset($subcategory->sub_category_logo)}}@else{{asset('defaults/noimage/no_img.jpg')}}@endif" alt="image">

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
