<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use DB;
use Validator;
use Str;

class ChildCategoryController extends Controller
{

    public function index()
    {

        $child_categories = DB::table('child_categories')
            ->join('categories','categories.id','child_categories.category_id')
            ->join('sub_categories','sub_categories.id','child_categories.sub_category_id')
            ->select('child_categories.*','categories.category_name','sub_categories.sub_category_name')
            ->get();
        return view('backend.childcategory.index',compact('child_categories'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $sub_categories = SubCategory::where('status', 1)->get();
        return view('backend.childcategory.create', compact('categories','sub_categories'));
    }



    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'child_category_name' => 'required|unique:child_categories',

        ]);


        if ($validator->fails()) {
            $notification = array(
                'message' => 'Opps! Something went wrong .Please Try Again.',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);

        }else {

            $childcategory = new ChildCategory();
            $childcategory->category_id = $request->category_id;
            $childcategory->sub_category_id = $request->sub_category_id;
            $childcategory->child_category_name = $request->child_category_name;
            $childcategory->child_category_name_slug = Str::slug($request->child_category_name);

            if ($request->file('child_category_logo')) {
                $child_category_logo = $request->file('child_category_logo');
                $extension = $child_category_logo->getClientOriginalExtension();
                $child_category_logo_name = "child_category_logo" . time() . "." . $extension;
                $child_category_logo->move(public_path('/uploads/childcategory/'), $child_category_logo_name);
                $childcategory->child_category_logo = "/uploads/childcategory/" . $child_category_logo_name;
            }

            $childcategory->status = 1;
            $childcategory->save();

            $notification = array(
                'message' => 'The new child category publish successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('childcategory.index')->with($notification);

        }


    }

    public function edit($id){
        $data['categories']  = Category::where('status', 1)->get();
        $data['sub_categories'] = SubCategory::where('status', 1)->get();
        $data['child_category']  = ChildCategory::findOrFail($id);
        return view('backend.childcategory.edit',$data);

    }

    public function update( Request $request,$id){

        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'child_category_name' => 'required|unique:child_categories',

        ]);


        $childcategory = ChildCategory::findOrFail($id);
        $childcategory->category_id = $request->category_id;
        $childcategory->sub_category_id = $request->sub_category_id;
        $childcategory->child_category_name = $request->child_category_name;
        $childcategory->child_category_name_slug = Str::slug($request->child_category_name);

        if ($request->file('child_category_logo')) {
            $image_path = public_path($childcategory->child_category_logo);
            if (file_exists($image_path)) {
                @unlink($image_path);
            }
            $child_category_logo = $request->file('child_category_logo');
            $extension = $child_category_logo->getClientOriginalExtension();
            $child_category_logo_name = "child_category_logo" . time() . "." . $extension;
            $child_category_logo->move(public_path('/uploads/childcategory/'), $child_category_logo_name);
            $childcategory->child_category_logo = "/uploads/childcategory/" . $child_category_logo_name;
        }


        $childcategory->status = 1;
        $childcategory->save();

        $notification = array(
            'message' => 'The Child category update successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('childcategory.index')->with($notification);

    }

    public function status($id){

        $childcategory = ChildCategory::findOrFail($id);
        if ($childcategory->status == 1) {
            $childcategory->status = 0;
        } else {
            $childcategory->status = 1;
        }
        $childcategory->save();

        $notification = array(
            'message' => 'The child category status update successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('childcategory.index')->with($notification);
    }
    public function delete($id){
        $childcategory = ChildCategory::findOrFail($id);
        $image_path = public_path($childcategory->child_category_logo);
        if (file_exists($image_path)) {
            @unlink($image_path);
        }

        $childcategory->delete();
        $notification = array(
            'message' => 'The Child Category delete successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('childcategory.index')->with($notification);
    }
}
