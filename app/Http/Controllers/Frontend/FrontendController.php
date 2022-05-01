<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\District;
use App\Models\Division;
use App\Models\Product;
use App\Models\Property;
use App\Models\Union;
use App\Models\Upazila;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index()
    {
        $divisions = Division::all();
        $properties = DB::table('properties')
            ->join('divisions','divisions.id','properties.division_id')
            ->join('districts','districts.id','properties.district_id')
            ->join('upazilas','upazilas.id','properties.upazila_id')
            ->join('unions','unions.id','properties.union_id')
            ->orderBy('id', 'DESC')
            ->select('properties.*')
            ->get();
//return $properties;


        return view('frontend.home', compact('divisions','properties'));
    }


    public function districts($division_id)
    {

        $districts = District::where('division_id', $division_id)->get();
        return $districts;

    }

    public function upazilas($district_id)
    {

        $upazilas = Upazila::where('district_id', $district_id)->get();
        return $upazilas;

    }

    public function unions($upazila_id)
    {

        $unions = Union::where('upazilla_id', $upazila_id)->get();
        return $unions;

    }

    public function properties(Request $request)
    {

        $properties = Property::where('division_id', $request->division_id)
            ->where('district_id', $request->district_id)
            ->where('upazila_id', $request->upazila_id)
            ->where('union_id', $request->union_id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('frontend.properties',compact('properties'));
    }


    public function propertyDetails($property_id){

        $property = Property::where('id', $property_id)->first();

        return view('frontend.details',compact('property'));

    }


}
