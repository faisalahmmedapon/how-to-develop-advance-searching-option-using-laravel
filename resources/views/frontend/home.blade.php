

@extends('frontend.layouts.index')

@section('content')

    <div class="container">

        <div class="row py-3">
            <div class="col-md-12">
                <h3 class="bg-success p-3 text-center text-white"><strong> <i> Search Your Nearest Properties </i></strong>
                </h3>
            </div>
        </div>

        <form action="{{'properties'}}" method="POST">
            @csrf


            <div class="row p-2">
                <div class="col-md-6 p-2">
                    <label id="division_id">Divisions </label>
                    <select class="form-select" aria-label="Divisions" id="division_id" name="division_id">
                        @foreach($divisions as $division)
                            <option value="{{$division->id}}">{{$division->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 p-2">
                    <label id=""> Districts </label>
                    <select class="form-select" aria-label="Districts" id="district_id" name="district_id">

                    </select>
                </div>

                <div class="col-md-6 p-2">
                    <label id=""> Upazilas </label>
                    <select class="form-select" aria-label="Upazilas" id="upazila_id" name="upazila_id">

                    </select>
                </div>

                <div class="col-md-6 p-2">
                    <label id=""> Unions </label>
                    <select class="form-select" aria-label="Unions" id="union_id" name="union_id">

                    </select>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm btn-success form-control"> Search</button>
                </div>
            </div>

        </form>

    </div>

    <div class="container">

        <div class="row">


            @foreach($properties as $property)

                <?php

                $division = \App\Models\Division::where('id', $property->division_id)->first();
                $district = \App\Models\District::where('id', $property->district_id)->first();
                $upazila = \App\Models\Upazila::where('id', $property->upazila_id)->first();
                $union = \App\Models\Union::where('id', $property->union_id)->first();

                ?>


                <div class="col-md-10 mx-auto p-2">
                    <div class="card shadow" id="property">
                        <a href="{{route('property.details',$property->id)}}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h6 class="card-title pb-4">{{$property->title}}</h6>
                                    <p class="card-title pb-4">{{$property->jomir_poriman}} শতক</p>
                                </div>
                                <p style="font-size: 15px"> Price:{{$property->property_discount_price}}k <sup>
                                        <del>{{$property->property_selling_price}}k
                                        </del>
                                    </sup>- Discount: @if($property->property_discount_type == 1)
                                        {{$property->property_discount}}tk @else {{$property->property_discount}}% @endif
                                </p>
                                <p style="font-size: 13px"
                                   class="card-text">{!! Str::limit($property->property_description,400) !!}</p>
                                <div class="d-flex justify-content-start">
                                    <div class="p-1">

                                        Division: <a href="#">  {{$division->name}} </a> ->
                                    </div>
                                    <div class="p-1">

                                        District: <a href="#"> {{$district->name}} </a> ->
                                    </div>
                                    <div class="p-1">

                                        Upazila: <a href="#"> {{$upazila->name}} </a> ->
                                    </div>
                                    <div class="p-1">

                                        Union: <a href="#">  {{$union->name}} </a>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-end">

                                    <div class="p-1">
                                        <?php
                                        $date = $property->created_at;

                                        $post_date = Carbon\Carbon::parse($date); // now date is a carbon instance
                                        $post_date_time = $post_date->diffForHumans();
                                        ?>
                                        <small class="text-right"> {{$post_date_time}}</small>

                                    </div>


                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>


@endsection



@section('js_link')
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
