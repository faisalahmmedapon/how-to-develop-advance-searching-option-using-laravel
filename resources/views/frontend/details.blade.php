@extends('frontend.layouts.index')

@section('content')

    <div class="container">

        <div class="row">


            <?php

            $division = \App\Models\Division::where('id', $property->division_id)->first();
            $district = \App\Models\District::where('id', $property->district_id)->first();
            $upazila = \App\Models\Upazila::where('id', $property->upazila_id)->first();
            $union = \App\Models\Union::where('id', $property->union_id)->first();

            ?>

            <div class="col-md-10 mx-auto p-2">
                <div class="card shadow p-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="card-title pb-4">{{$property->title}}</h6>
                            <p class="card-title pb-4">{{$property->jomir_poriman}} শতক</p>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $property_images = json_decode($property->property_image);
                                //                            dd($property_images)
                                ?>

                                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($property_images as $key=>$property_image)

                                            <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                                                <img height="250px" src="{{asset($property_image)}}"
                                                     class="d-block w-100"
                                                     alt="...">
                                            </div>
                                        @endforeach

                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>


                    </div>

                    <p style="font-size: 15px"> Price:{{$property->property_discount_price}}k <sup>
                            <del>{{$property->property_selling_price}}k
                            </del>
                        </sup>- Discount: @if($property->property_discount_type == 1)
                            {{$property->property_discount}}tk @else {{$property->property_discount}}% @endif
                    </p>
                    <p style="font-size: 13px"
                       class="card-text"> <strong>Description:</strong> <br> {!! $property->property_description !!}</p>

                    <p style="font-size: 13px"
                       class="card-text"> <strong>Conditions:</strong> <br>  {!! $property->property_conditions !!}</p>

                    <p style="font-size: 13px"
                       class="card-text"> <strong>Related Information :</strong> <br>  {!! $property->related_brif !!}</p>
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
            </div>
        </div>
    </div>

@endsection
