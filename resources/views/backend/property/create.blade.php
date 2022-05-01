@extends('backend.layouts.index')
@section('add_css_in_main_css_place')

@endsection

@section('title')
    | Properties Create
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 col-md-12 col-lg-12 d-flex justify-content-end">
                    <a href="{{route('property.index')}}" class="btn btn-info"> <i class="fa fa-list"> Properties Lists </i>  </a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <form action="{{route('property.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">


                    <div class=" col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label id="division_id">Divisions </label>
                            <select class="form-select form-control" aria-label="Divisions" id="division_id" name="division_id">
                                @foreach($divisions as $division)
                                    <option value="{{$division->id}}">{{$division->name}}</option>
                                @endforeach
                            </select>
                            <div
                                style='color:red; padding: 0 5px;'>{{($errors->has('property_name'))?($errors->first('property_name')):''}}</div>
                        </div>
                    </div>


                    <div class=" col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label id=""> Districts </label>
                            <select class="form-select form-control" aria-label="Districts" id="district_id" name="district_id">
                            </select>
                            <div
                                style='color:red; padding: 0 5px;'>{{($errors->has('property_name'))?($errors->first('property_name')):''}}</div>
                        </div>
                    </div>


                    <div class=" col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label id=""> Upazilas </label>
                            <select class="form-select form-control" aria-label="Upazilas" id="upazila_id" name="upazila_id">

                            </select>
                            <div
                                style='color:red; padding: 0 5px;'>{{($errors->has('property_name'))?($errors->first('property_name')):''}}</div>
                        </div>
                    </div>


                    <div class=" col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label id=""> Unions </label>
                            <select class="form-select form-control" aria-label="Unions" id="union_id" name="union_id">
                            </select>
                            <div
                                style='color:red; padding: 0 5px;'>{{($errors->has('property_name'))?($errors->first('property_name')):''}}</div>
                        </div>
                    </div>




                    <div class=" col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="title">  Title: </label>
                            <input type="text" name="title" class="form-control" value="{{old('title')}}"
                                   id="title">
                            <div
                                style='color:red; padding: 0 5px;'>{{($errors->has('title'))?($errors->first('title')):''}}</div>
                        </div>
                    </div>

                    <div class=" col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="jomir_poriman">  Jomir Poriman: </label>
                            <input type="text" name="jomir_poriman" class="form-control" value="{{old('jomir_poriman')}}"
                                   id="jomir_poriman">
                            <div
                                style='color:red; padding: 0 5px;'>{{($errors->has('jomir_poriman'))?($errors->first('jomir_poriman')):''}}</div>
                        </div>
                    </div>


                    <div class=" col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="property_selling_price">  Price: </label>
                            <input type="number" name="property_selling_price" class="form-control" value="{{old('property_selling_price')}}"
                                   id="property_selling_price">
                            <div
                                style='color:red; padding: 0 5px;'>{{($errors->has('property_selling_price'))?($errors->first('property_selling_price')):''}}</div>
                        </div>
                    </div>

                    <div class=" col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="property_discount_type">  Discount Type </label>
                            <select class="form-control" name="property_discount_type" id="property_discount_type" >
                                    <option value="1"> Amount </option>
                                    <option value="2"> Percentage </option>
                            </select>
                        </div>
                    </div>


                    <div class=" col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="property_discount"> Discount: </label>
                            <input type="number" name="property_discount" class="form-control"
                                   id="property_discount" value="0" min="0">
                            <div
                                style='color:red; padding: 0 5px;'>{{($errors->has('property_discount'))?($errors->first('property_discount')):''}}</div>
                        </div>
                    </div>

                    <div class=" col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="property_discount_price">  Discount Price: </label>
                            <input readonly type="number" name="property_discount_price" class="form-control" value="0.00"
                                   id="property_discount_price">
                            <div
                                style='color:red; padding: 0 5px;'>{{($errors->has('property_discount_price'))?($errors->first('property_discount_price')):''}}</div>
                        </div>
                    </div>


                    <div class=" col-sm-12 col-md-12 col-lg-12 py-3">
                        <label for="defaultImage">  Image </label>
                        <div class="input-group control-group increment" >
                            <input type="file" name="property_image[]" class="form-control" id="defaultImage">
                            <div class="input-group-btn p-1">
                                <button class="btn btn-success btn-sm " type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                            </div>
                        </div>

                        <div class="clone hide">
                            <div class="control-group input-group" style="margin-top:10px">
                                <input type="file" name="property_image[]" class="form-control" id="defaultImage1">
                                <div class="input-group-btn p-1">
                                    <button class="btn btn-danger btn-sm " type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class=" col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="property_description"> Description: </label>
                            <textarea name="property_description" rows="10" class="form-control summernote" id="property_description"> {{old('property_description')}} </textarea>
                            <div
                                style='color:red; padding: 0 5px;'>{{($errors->has('property_description'))?($errors->first('property_description')):''}}</div>
                        </div>
                    </div>



                    <div class=" col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="property_conditions"> Conditions: </label>
                            <textarea name="property_conditions" rows="10" class="form-control summernote" id="property_conditions"> {{old('property_conditions')}} </textarea>
                            <div
                                style='color:red; padding: 0 5px;'>{{($errors->has('property_conditions'))?($errors->first('property_conditions')):''}}</div>
                        </div>
                    </div>


                    <div class=" col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="related_brif"> Related Brif:(optional) </label>
                            <textarea  name="related_brif" rows="10" class="form-control summernote"> {{old('related_brif')}} </textarea>
                            <div
                                style='color:red; padding: 0 5px;'>{{($errors->has('related_brif'))?($errors->first('related_brif')):''}}</div>
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
                const html = $(".clone").html();
                $(".increment").after(html);
            });

            $("body").on("click",".btn-danger",function(){
                $(this).parents(".control-group").remove();
            });

        });

    </script>


    <script>


        function offer() {
            var property_selling_price = $('#property_selling_price').val();
            var property_discount_type = $('#property_discount_type').val();
            var property_discount = $('#property_discount').val();

            if (property_discount_type == 1) {
                var property_discount_price = property_selling_price - property_discount;
            } else if (property_discount_type == 2) {
                var price_cal = ((property_selling_price * property_discount) / 100);
                var property_discount_price = property_selling_price - price_cal;
            } else {
                var property_discount_price = 0;
            }

            if (!isNaN(property_discount_price)) {
                $('#property_discount_price').val(property_discount_price);
            }
        }

        $('#property_selling_price, #property_discount_type, #property_discount, #property_discount_price').on('keyup change', function () {
            offer();
        });

    </script>

    <script>
        $(function () {
            $(document).on('change', '#division_id', function () {
                var division_id = $(this).val();
                $.ajax({
                    type: "Get",
                    url: "{{url('/districts')}}/" + division_id,
                    dataType: "json",
                    success: function (data) {
                        var html = '<option value="">Select Districts</option>';
                        $.each(data, function (key, val) {
                            html += '<option value="' + val.id + '">' + val.name + '</option>';
                        });
                        $('#district_id').html(html);
                    },

                });
            });
        });

    </script>

    <script>
        $(function () {
            $(document).on('change', '#district_id', function () {
                var district_id = $(this).val();
                $.ajax({
                    type: "Get",
                    url: "{{url('/upazilas')}}/" + district_id,
                    dataType: "json",
                    success: function (data) {
                        var html = '<option value="">Select Upazilas</option>';
                        $.each(data, function (key, val) {
                            html += '<option value="' + val.id + '">' + val.name + '</option>';
                        });
                        $('#upazila_id').html(html);
                    },

                });
            });
        });

    </script>


    <script>
        $(function () {
            $(document).on('change', '#upazila_id', function () {
                var upazila_id = $(this).val();
                $.ajax({
                    type: "Get",
                    url: "{{url('/unions')}}/" + upazila_id,
                    dataType: "json",
                    success: function (data) {
                        var html = '<option value="">Select Unions</option>';
                        $.each(data, function (key, val) {
                            html += '<option value="' + val.id + '">' + val.name + '</option>';
                        });
                        $('#union_id').html(html);
                    },

                });
            });
        });

    </script>


@endsection
