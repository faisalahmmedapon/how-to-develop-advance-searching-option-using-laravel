@extends('backend.layouts.index')

@section('title')
    | Products
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 col-md-12 col-lg-12 d-flex justify-content-end">
                    <a href="{{route('property.create')}}" class="btn btn-success"> <i class="fa fa-plus"> New
                            Property </i> </a>
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
                            <th> SL</th>
                            <th> Districts  </th>
                            <th> Divisions </th>
                            <th> Upazilas </th>
                            <th> Unions  </th>
                            <th> Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($properties as $key=>$property)

                            <tr>
                                <th>{{$key+1}}</th>
                                <td>{{$property->product_name}}</td>
                                <td>{{$property->product_quantity}}</td>
                                <td>{{$property->product_discount_price}}</td>
                                <td>
                                    <a href="{{route('property.show',$property->id)}}" class="btn"> <i
                                            class="fa fa-eye"> </i> </a>
                                    @if($property->status == 1)
                                        <a href="{{route('property.status',$property->id)}}" class="btn"> <i
                                                class="fa fa-thumbs-up"> </i> </a>
                                    @else
                                        <a href="{{route('property.status',$property->id)}}" class="btn"> <i
                                                class="fa fa-thumbs-down"> </i> </a>
                                    @endif
                                    <a href="{{route('property.edit',$property->id)}}" class="btn"> <i
                                            class="fa fa-edit"> </i> </a>
                                    <a href="{{route('property.delete',$property->id)}}" class="btn"> <i
                                            class="fa fa-trash"> </i> </a>
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
