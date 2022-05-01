@extends('backend.layouts.index')
@section('add_css_in_main_css_place')
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: #000;
    }
</style>
@endsection

@section('title')
    | Product Create
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

    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">




                    <div class=" col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="product_category"> Select Category </label>
                            <select class="form-control myselect2" name="category_id[]" multiple="multiple" id="product_category">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"> {{$category->category_name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class=" col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="product_color"> Select Sub Category </label>
                            <select class="form-control myselect2" name="sub_category_id[]" multiple="multiple" id="product_color">
                                @foreach($sub_categories as $sub_category)
                                    <option value="{{$sub_category->id}}"> {{$sub_category->sub_category_name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class=" col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="product_material"> Select Child Category </label>
                            <select class="form-control myselect2" name="child_category_id[]" multiple="multiple" id="product_material">
                                @foreach($child_categories as $child_category)
                                    <option value="{{$child_category->id}}"> {{$child_category->child_category_name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>




                    <div class=" col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="product_name"> Product Title: </label>
                            <input type="text" name="product_name" class="form-control" value="{{old('product_name')}}"
                                   id="brand_name">
                            <div
                                style='color:red; padding: 0 5px;'>{{($errors->has('product_name'))?($errors->first('product_name')):''}}</div>
                        </div>
                    </div>
                    <div class=" col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="product_quantity"> Product Quantity: </label>
                            <input type="number" name="product_quantity" class="form-control" value="{{old('product_quantity')}}"
                                   id="product_quantity">
                            <div
                                style='color:red; padding: 0 5px;'>{{($errors->has('product_quantity'))?($errors->first('product_quantity')):''}}</div>
                        </div>
                    </div>


                    <div class=" col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="product_selling_price"> Product Price: </label>
                            <input type="number" name="product_selling_price" class="form-control" value="{{old('product_selling_price')}}"
                                   id="product_selling_price">
                            <div
                                style='color:red; padding: 0 5px;'>{{($errors->has('product_selling_price'))?($errors->first('product_selling_price')):''}}</div>
                        </div>
                    </div>

                    <div class=" col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="product_discount_type"> Products Discount Type </label>
                            <select class="form-control" name="product_discount_type" id="product_discount_type" >
                                    <option value="1"> Amount </option>
                                    <option value="2"> Percentage </option>
                            </select>
                        </div>
                    </div>


                    <div class=" col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="product_discount"> Discount: </label>
                            <input type="number" name="product_discount" class="form-control"
                                   id="product_discount" value="0" min="0">
                            <div
                                style='color:red; padding: 0 5px;'>{{($errors->has('product_discount'))?($errors->first('product_discount')):''}}</div>
                        </div>
                    </div>

                    <div class=" col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="product_discount_price"> Product Discount Price: </label>
                            <input readonly type="number" name="product_discount_price" class="form-control" value="0.00"
                                   id="product_discount_price">
                            <div
                                style='color:red; padding: 0 5px;'>{{($errors->has('product_discount_price'))?($errors->first('product_discount_price')):''}}</div>
                        </div>
                    </div>

{{--                    <div class=" col-sm-12 col-md-6 col-lg-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="product_brand"> Select Brand </label>--}}
{{--                            <select class="form-control " name="product_brand" id="product_brand">--}}
{{--                                @foreach($brands as $brand)--}}
{{--                                    <option value="{{$brand->id}}"> {{$brand->brand_name}} </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class=" col-sm-12 col-md-12 col-lg-12 py-3">
                        <label for="defaultImage"> Product Image </label>
                        <div class="input-group control-group increment" >
                            <input type="file" name="product_image[]" class="form-control" id="defaultImage">
                            <div class="input-group-btn p-1">
                                <button class="btn btn-success btn-sm " type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                            </div>
                        </div>

                        <div class="clone hide">
                            <div class="control-group input-group" style="margin-top:10px">
                                <input type="file" name="product_image[]" class="form-control" id="defaultImage1">
                                <div class="input-group-btn p-1">
                                    <button class="btn btn-danger btn-sm " type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class=" col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="product_short_description"> Product Short Description: </label>
                            <textarea name="product_short_description" rows="10" class="form-control summernote" id="product_short_description"> {{old('product_short_description')}} </textarea>
                            <div
                                style='color:red; padding: 0 5px;'>{{($errors->has('product_short_description'))?($errors->first('product_short_description')):''}}</div>
                        </div>
                    </div>



                    <div class=" col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="product_description"> Product Description: </label>
                            <textarea name="product_description" rows="10" class="form-control summernote" id="product_description"> {{old('product_description')}} </textarea>
                            <div
                                style='color:red; padding: 0 5px;'>{{($errors->has('product_description'))?($errors->first('product_description')):''}}</div>
                        </div>
                    </div>


                    <div class=" col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="product_specification"> Product Specification: </label>
                            <textarea  name="product_specification" rows="10" class="form-control summernote"> {{old('product_specification')}} </textarea>
                            <div
                                style='color:red; padding: 0 5px;'>{{($errors->has('product_specification'))?($errors->first('product_specification')):''}}</div>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-success"> SUBMIT </button>
            </form>

        </div>

    </section>
@endsection


@section('add_js_in_main_js_place')
    <script type="text/javascript">

        $(document).ready(function() {

            $(".btn-success").click(function(){
                var html = $(".clone").html();
                $(".increment").after(html);
            });

            $("body").on("click",".btn-danger",function(){
                $(this).parents(".control-group").remove();
            });

        });

    </script>


    <script>


        function offer() {
            var product_selling_price = $('#product_selling_price').val();
            var product_discount_type = $('#product_discount_type').val();
            var product_discount = $('#product_discount').val();

            if (product_discount_type == 1) {
                var product_discount_price = product_selling_price - product_discount;
            } else if (product_discount_type == 2) {
                var price_cal = ((product_selling_price * product_discount) / 100);
                var product_discount_price = product_selling_price - price_cal;
            } else {
                var product_discount_price = 0;
            }

            if (!isNaN(product_discount_price)) {
                $('#product_discount_price').val(product_discount_price);
            }
        }

        $('#product_selling_price, #product_discount_type, #product_discount, #product_discount_price').on('keyup change', function () {
            offer();
        });

    </script>

@endsection
