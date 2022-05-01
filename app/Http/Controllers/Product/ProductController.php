<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use DB;
use Validator;
use Str;

class ProductController extends Controller
{
    public function index()
    {
        $data['products'] = Product::latest()->get();

        // this code for product category name
        foreach ($data['products'] as $product){
            $data['product_categories'] = json_decode($product->category_id);
        }
        return view('backend.product.index', $data);
    }

    public function create()
    {
        $data['categories'] = Category::all();
        $data['sub_categories'] = SubCategory::all();
        $data['child_categories'] = ChildCategory::all();
        return view('backend.product.create', $data);
    }

    public function store(Request $request)
    {


//        return $request->all();

        $validator = Validator::make($request->all(), [
            //'product_name' => 'required|unique:products',
            'product_name' => 'required',
            'product_quantity' => 'required',
            'product_selling_price' => 'required',
            'product_discount_type' => 'required',
            'product_discount' => 'required',
            'product_discount_price' => 'required',
            'product_image' => 'required',
            'product_image.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'product_short_description' => 'required',
            'product_description' => 'required',
            'product_specification' => 'required',

        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Opps! Something went wrong .Please Try Again.',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);

        } else {

            $product = new Product();
            $product->category_id = json_encode($request->category_id);;
            $product->sub_category_id = json_encode($request->sub_category_id);;
            $product->child_category_id = json_encode($request->child_category_id);;
            $product->product_name = $request->product_name;
            $product->product_name_slug = Str::slug($request->product_name);
            $product->product_quantity = $request->product_quantity;
            $product->product_selling_price = $request->product_selling_price;
            $product->product_discount_type = $request->product_discount_type;
            $product->product_discount = $request->product_discount;
            $product->product_discount_price = $request->product_discount_price;
            $product->product_short_description = $request->product_short_description;
            $product->product_description = $request->product_description;
            $product->product_specification = $request->product_specification;
            if ($request->hasfile('product_image')) {
                foreach ($request->file('product_image') as $image) {
                    $name = "product_" . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/product/'), $name);
//                $image->move(public_path().'uploads/images/', $name);
                    $data[] = 'uploads/product/' . $name;
                }
            }
            $product->product_image = json_encode($data);
            $product->status = 1;
            $product->save();

            $notification = array(
                'message' => 'New Product publish Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('product.index')->withErrors($validator)->withInput()->with($notification);

        }


    }


    public function edit($id)
    {

        $data['product'] = Product::findOrFail($id);

        // this code for product category name
        $data['product_categories'] = json_decode( $data['product']->category_id);


        // this code for product sub category name
        $data['product_sub_categories'] = json_decode($data['product']->sub_category_id);


        //this code for product child category name
        $data['product_child_categories'] = json_decode($data['product']->child_category_id);

        $data['categories'] = Category::all();
        $data['sub_categories'] = SubCategory::all();
        $data['child_categories'] = ChildCategory::all();

        return view('backend.product.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            //'product_name' => 'required|unique:products',
            'product_name' => 'required',
            'product_quantity' => 'required',
            'product_selling_price' => 'required',
            'product_discount_type' => 'required',
            'product_discount' => 'required',
            'product_discount_price' => 'required',
            'product_image.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'product_short_description' => 'required',
            'product_description' => 'required',
            'product_specification' => 'required',

        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Opps! Something went wrong .Please Try Again.',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);

        } else {
            $product = Product::findOrFail($id);
            $product->category_id = json_encode($request->category_id);;
            $product->sub_category_id = json_encode($request->sub_category_id);;
            $product->child_category_id = json_encode($request->child_category_id);;
            $product->product_name = $request->product_name;
            $product->product_name_slug = Str::slug($request->product_name);
            $product->product_quantity = $request->product_quantity;
            $product->product_selling_price = $request->product_selling_price;
            $product->product_discount_type = $request->product_discount_type;
            $product->product_discount = $request->product_discount;
            $product->product_discount_price = $request->product_discount_price;
            $product->product_short_description = $request->product_short_description;
            $product->product_description = $request->product_description;
            $product->product_specification = $request->product_specification;

            $product_images = $request->hasfile('product_image');
            if ($product_images) {
                $get_product_images = json_decode($product->product_image);
                foreach ($get_product_images as $get_product_image) {
                    if (file_exists($get_product_image)) {
                        @unlink($get_product_image);
                    }
                }

                foreach ($request->file('product_image') as $image) {
                    $name = "product_" . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/product/'), $name);
//                $image->move(public_path().'uploads/images/', $name);
                    $data[] = 'uploads/product/' . $name;
                }
                $product->product_image = json_encode($data);
            }
            $product->status = 1;
            $product->save();

        }
        $notification = array(
            'message' => 'Product  Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('product.index')->with($notification);

    }


    public function show($id)
    {

        $data['product'] = Product::where('id', $id)->first();

        // this code for product category name
            $data['product_categories'] = json_decode( $data['product']->category_id);


        // this code for product sub category name
            $data['product_sub_categories'] = json_decode($data['product']->sub_category_id);


        //this code for product child category name
            $data['product_child_categories'] = json_decode($data['product']->child_category_id);

        $data['product_images'] = json_decode($data['product']->product_image);

        return view('backend.product.details', $data);

    }


    public function status($id)
    {
        $product = Product::findOrFail($id);
        if ($product->status == 1) {
            $product->status = 0;
        } else {
            $product->status = 1;
        }
        $product->save();

        $notification = array(
            'message' => 'The Product status update successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('product.index')->with($notification);
    }

    public function delete($id)
    {

        $product = Product::findOrFail($id);

        $get_product_images = json_decode($product->product_image);
        foreach ($get_product_images as $get_product_image) {
            if (file_exists($get_product_image)) {
                @unlink($get_product_image);
            }
        }

        $product->delete();

        $notification = array(
            'message' => 'The Product delete successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('product.index')->with($notification);

    }
}
