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
                    <a href="{{route('product.index')}}" class="btn btn-info"> <i class="fa fa-list"> Products Lists </i>  </a>
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

                        <tbody>
                        <tr>
                            <th> Category Name</th>
                            <td>
                                @foreach($product_categories as $product_category)
                                    <?php
                                    $data =    \App\Models\Category::where('id',$product_category)->first();
                                    echo "<a class='btn btn-sm btn-info'>$data->category_name</a>";
                                    ?>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th> Sub Category Name</th>
                            <td>
                                @foreach($product_sub_categories as $product_sub_category)
                                    <?php
                                    $data =    \App\Models\SubCategory::where('id',$product_sub_category)->first();
                                    echo "<a class='btn btn-sm btn-info'>$data->sub_category_name</a>";
                                    ?>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th> Child Category Name</th>
                            <td>
                                @foreach($product_child_categories as $product_child_category)
                                    <?php
                                    $data =    \App\Models\ChildCategory::where('id',$product_child_category)->first();
                                    echo "<a class='btn btn-sm btn-info'>$data->child_category_name</a>";
                                    ?>
                                @endforeach
                            </td>
                        </tr>


                        <tr>
                            <th> Product Name</th>
                            <td> {{$product->product_name}} </td>
                        </tr>


                        <tr>
                            <th> Product Quantity</th>
                            <td> {{$product->product_quantity}} QTY </td>
                        </tr>


                        <tr>
                            <th> Product Selling Price</th>
                            <td> TK {{$product->product_selling_price}} </td>
                        </tr>

                        <tr>
                            <th> Product Discount Type</th>
                            <td> @if($product->product_discount_type == 1)
                                     <p>Amount</p>
                                @else
                                    <p>Percentage</p>
                                @endif
                        </tr>

                        <tr>
                            <th> Product Discount</th>
                            <td> TK {{$product->product_discount}} </td>
                        </tr>


                        <tr>
                            <th> Product Discount Price</th>
                            <td> TK {{$product->product_discount_price}} </td>
                        </tr>


                        <tr>
                            <th> Product Short Description</th>
                            <td> {!! $product->product_short_description !!} </td>
                        </tr>

                        <tr>
                            <th> Product Description</th>
                            <td> {!! $product->product_description !!} </td>
                        </tr>


                        <tr>
                            <th> Product Specification</th>
                            <td> {!! $product->product_specification !!} </td>
                        </tr>

{{--                        <tr>--}}
{{--                            <th> Product Color </th>--}}
{{--                            <td>--}}
{{--                                @foreach($product_colors as $product_color)--}}
{{--                                    <button class="btn btn-default">{{$product_color->color_name}}</button>--}}
{{--                                @endforeach--}}

{{--                            </td>--}}
{{--                        </tr>--}}

{{--                        <tr>--}}
{{--                            <th> Product Category </th>--}}
{{--                            <td>--}}
{{--                                <button class="btn btn-default"> {{$product_category->category_name}}</button>--}}

{{--                            </td>--}}
{{--                        </tr>--}}

{{--                        <tr>--}}
{{--                            <th> Product Materials </th>--}}
{{--                            <td>--}}
{{--                                @foreach($product_materials as $product_material)--}}
{{--                                    <button class="btn btn-default">{{$product_material->material_name}}</button>--}}
{{--                                @endforeach--}}
{{--                            </td>--}}
{{--                        </tr>--}}

                        <tr>
                            <th> Product Images</th>
                            <td>
                                @foreach ($product_images as $key=>$data)
                                    <img class="shadow p-2" width="350px" height="170px" src="{{asset($data)}}">
                                @endforeach
                            </td>

                        </tr>


                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->

        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

@endsection
