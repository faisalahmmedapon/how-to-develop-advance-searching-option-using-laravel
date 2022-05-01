@extends('backend.layouts.index')

@section('title')
    | Sub Categories
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 col-md-12 col-lg-12 d-flex justify-content-end">
                    <a href="{{route('subcategory.create')}}" class="btn btn-success"> <i class="fa fa-plus"> New Sub Category </i> </a>
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
                            <th scope="col">Category Name</th>
                            <th scope="col">Sub Category Name</th>
                            <th scope="col"> Sub Category Logo </th>
                            <th scope="col"> Action </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($sub_categories as $key=>$sub_category)
                        <tr>
                            <th>{{$key+1}}</th>
                            <td>{{$sub_category->category_name}}</td>
                            <td>{{$sub_category->sub_category_name}}</td>
                            <td><img width="200px" height="100px" src="{{asset($sub_category->sub_category_logo)}}"></td>
                            <td>
                                @if($sub_category->status == 1)
                                    <a href="{{route('subcategory.status',$sub_category->id)}}" class="btn"> <i class="fa fa-thumbs-up"> </i> </a>
                                @else
                                    <a href="{{route('subcategory.status',$sub_category->id)}}" class="btn"> <i class="fa fa-thumbs-down"> </i> </a>
                                @endif
                                    <a href="{{route('subcategory.edit',$sub_category->id)}}" class="btn"> <i class="fa fa-edit"> </i> </a>
                                <a href="{{route('subcategory.delete',$sub_category->id)}}" class="btn"> <i class="fa fa-trash"> </i> </a>
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
