

@extends('frontend.layouts.index')

@section('content')

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

                                    <small class="text-right"> {{$property->created_at->diffForHumans()}}</small>

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
