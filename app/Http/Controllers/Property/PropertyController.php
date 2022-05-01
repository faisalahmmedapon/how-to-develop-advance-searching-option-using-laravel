<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Validator;
use Str;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::all();
        return view('backend.property.index', compact('properties'));
    }

    public function create()
    {
        $divisions = Division::all();
        return view('backend.property.create', compact('divisions'));
    }


    public function store(Request $request)
    {

//        return $request->all();

        $validator = Validator::make($request->all(), [
            'division_id' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
            'union_id' => 'required',
            'title' => 'required',
            'jomir_poriman' => 'required',
            'property_selling_price' => 'required',
            'property_discount_type' => 'required',
            'property_discount' => 'required',
            'property_discount_price' => 'required',
            'property_image' => 'required',
            'property_image.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'property_description' => 'required',
            'property_conditions' => 'required',
            'related_brif' => 'required',

        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Opps! Something went wrong .Please Try Again.',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);

        } else {

            $property = new Property();

            $property->division_id = $request->division_id;
            $property->district_id = $request->district_id;
            $property->upazila_id = $request->upazila_id;
            $property->union_id = $request->union_id;
            $property->title = $request->title;
            $property->title_slug = Str::slug($request->title);
            $property->jomir_poriman = $request->jomir_poriman;
            $property->property_selling_price = $request->property_selling_price;
            $property->property_discount_type = $request->property_discount_type;
            $property->property_discount = $request->property_discount;
            $property->property_discount_price = $request->property_discount_price;
            $property->property_description = $request->property_description;
            $property->property_conditions = $request->property_conditions;
            $property->related_brif = $request->related_brif;
            if ($request->hasfile('property_image')) {
                foreach ($request->file('property_image') as $image) {
                    $name = "property_" . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/property/'), $name);
                    $data[] = 'uploads/property/' . $name;
                }
            }
            $property->property_image = json_encode($data);
            $property->status = 1;
            $property->save();

            $notification = array(
                'message' => 'New property publish Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('property.index')->withErrors($validator)->withInput()->with($notification);

        }


    }


}
