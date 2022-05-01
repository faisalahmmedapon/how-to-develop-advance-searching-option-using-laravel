@extends('backend.layouts.index')


@section('title')
    | Child Categories
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 col-md-12 col-lg-12 d-flex justify-content-end">
                    <a href="{{route('childcategory.create')}}" class="btn btn-success"> <i class="fa fa-plus"> New Child Category </i> </a>
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
                            <th scope="col">Child Category Name</th>
                            <th scope="col"> Child Category Logo </th>
                            <th scope="col"> Action </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($child_categories as $key=>$child_category)
                        <tr>
                            <th>{{$key+1}}</th>
                            <td>{{$child_category->category_name}}</td>
                            <td>{{$child_category->sub_category_name}}</td>
                            <td>{{$child_category->child_category_name}}</td>
                            <td><img width="200px" height="100px" src="{{asset($child_category->child_category_logo)}}"></td>
                            <td>
                                @if($child_category->status == 1)
                                    <a href="{{route('childcategory.status',$child_category->id)}}" class="btn"> <i class="fa fa-thumbs-up"> </i> </a>
                                @else
                                    <a href="{{route('childcategory.status',$child_category->id)}}" class="btn"> <i class="fa fa-thumbs-down"> </i> </a>
                                @endif
                                    <a href="{{route('childcategory.edit',$child_category->id)}}" class="btn"> <i class="fa fa-edit"> </i> </a>
                                <a href="{{route('childcategory.delete',$child_category->id)}}" class="btn"> <i class="fa fa-trash"> </i> </a>
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
