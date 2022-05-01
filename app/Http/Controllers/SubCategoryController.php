<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use DB;
use Validator;
use Str;

class SubCategoryController extends Controller
{
    public function index()
    {

        $sub_categories = DB::table('sub_categories')
            ->join('categories','categories.id','sub_categories.category_id')
            ->select('sub_categories.*','categories.category_name')
            ->get();
        return view('backend.subcategory.index',compact('sub_categories'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('backend.subcategory.create', compact('categories'));
    }



    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'sub_category_name' => 'required|unique:sub_categories',

        ]);


        if ($validator->fails()) {
            $notification = array(
                'message' => 'Opps! Something went wrong .Please Try Again.',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);

        }else {

            $subcategory = new SubCategory();
            $subcategory->category_id = $request->category_id;
            $subcategory->sub_category_name = $request->sub_category_name;
            $subcategory->sub_category_name_slug = Str::slug($request->category_name);

            if ($request->file('sub_category_logo')) {
                $sub_category_logo = $request->file('sub_category_logo');
                $extension = $sub_category_logo->getClientOriginalExtension();
                $sub_category_logo_name = "sub_category_logo" . time() . "." . $extension;
                $sub_category_logo->move(public_path('/uploads/subcategory/'), $sub_category_logo_name);
                $subcategory->sub_category_logo = "/uploads/subcategory/" . $sub_category_logo_name;
            }

            $subcategory->status = 1;
            $subcategory->save();

            $notification = array(
                'message' => 'The new sub category publish successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('subcategory.index')->with($notification);

        }


    }

    public function edit($id){
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::where('status', 1)->get();
        return view('backend.subcategory.edit',compact('categories','subcategory'));

    }

    public function update( Request $request,$id){

        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'sub_category_name' => 'required|unique:sub_categories',

        ]);


        $subcategory = SubCategory::findOrFail($id);
        $subcategory->category_id = $request->category_id;
        $subcategory->sub_category_name = $request->sub_category_name;
        $subcategory->sub_category_name_slug = Str::slug($request->category_name);

        if ($request->file('sub_category_logo')) {
            $image_path = public_path($subcategory->sub_category_logo);
            if (file_exists($image_path)) {
                @unlink($image_path);
            }
            $sub_category_logo = $request->file('sub_category_logo');
            $extension = $sub_category_logo->getClientOriginalExtension();
            $sub_category_logo_name = "sub_category_logo" . time() . "." . $extension;
            $sub_category_logo->move(public_path('/uploads/subcategory/'), $sub_category_logo_name);
            $subcategory->sub_category_logo = "/uploads/subcategory/" . $sub_category_logo_name;
        }


        $subcategory->status = 1;
        $subcategory->save();

        $notification = array(
            'message' => 'The category update successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('subcategory.index')->with($notification);

    }

    public function status($id){

        $subcategory = SubCategory::findOrFail($id);
        if ($subcategory->status == 1) {
            $subcategory->status = 0;
        } else {
            $subcategory->status = 1;
        }
        $subcategory->save();

        $notification = array(
            'message' => 'The sub category status update successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('subcategory.index')->with($notification);
    }
    public function delete($id){
        $subcategory = SubCategory::findOrFail($id);
        $image_path = public_path($subcategory->sub_category_logo);
        if (file_exists($image_path)) {
            @unlink($image_path);
        }

        $subcategory->delete();
        $notification = array(
            'message' => 'The Sub Category delete successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('subcategory.index')->with($notification);
    }

}
