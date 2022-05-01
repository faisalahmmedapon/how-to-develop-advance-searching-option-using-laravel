<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Validator;
use Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('backend.category.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.category.create');
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category_name' => 'required|unique:categories'
        ]);


        if ($validator->fails()) {
            $notification = array(
                'message' => 'Opps! Something went wrong .Please Try Again.',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);

        } else {

            $category = new Category();
            $category->category_name = $request->category_name;
            $category->category_name_slug = Str::slug($request->category_name);

            if ($request->file('category_logo')) {
                $brand_logo = $request->file('category_logo');
                $extension = $brand_logo->getClientOriginalExtension();
                $logo_name = "category_logo" . time() . "." . $extension;
                $brand_logo->move(public_path('/uploads/category/'), $logo_name);
                $category->category_logo = "/uploads/category/" . $logo_name;
            }

            $category->status = 1;
            $category->save();

            $notification = array(
                'message' => 'The new category publish successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('category.index')->with($notification);

        }


    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.edit', compact('category'));

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|unique:categories'
        ]);


        if ($validator->fails()) {
            $notification = array(
                'message' => 'Opps! Something went wrong .Please Try Again.',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);

        } else {

            $category = Category::findOrFail($id);
            $category->category_name = $request->category_name;
            $category->category_name_slug = Str::slug($request->category_name);

            if ($request->file('category_logo')) {
                $image_path = public_path($category->category_logo);
                if (file_exists($image_path)) {
                    @unlink($image_path);
                }

                $brand_logo = $request->file('category_logo');
                $extension = $brand_logo->getClientOriginalExtension();
                $logo_name = "logo" . time() . "." . $extension;
                $brand_logo->move(public_path('/uploads/category/'), $logo_name);
                $category->brand_logo = "/uploads/category/" . $logo_name;
            }
            $category->status = 1;
            $category->save();

            $notification = array(
                'message' => 'The category update successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('category.index')->with($notification);

        }
    }

    public function status($id)
    {
        $category = Category::findOrFail($id);
        if ($category->status == 1) {
            $category->status = 0;
        } else {
            $category->status = 1;
        }
        $category->save();

        $notification = array(
            'message' => 'The category status update successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('category.index')->with($notification);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $image_path = public_path($category->category_logo);
        if (file_exists($image_path)) {
            @unlink($image_path);
        }

        $category->delete();
        $notification = array(
            'message' => 'The Category delete successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('category.index')->with($notification);
    }

}
