<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use DB;
use Validator;
use Str;


class PostController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')
            ->join('categories', 'categories.id', 'posts.category_id')
            ->join('sub_categories', 'sub_categories.id', 'posts.sub_category_id')
            ->join('child_categories', 'child_categories.id', 'posts.child_category_id')
            ->select('posts.*', 'categories.category_name','sub_categories.sub_category_name','child_categories.child_category_name')
            ->get();
//        return $posts;
        return view('backend.post.index', compact('posts'));
    }


    public function create()
    {
        $data['categories'] = Category::where('status', 1)->get();
        $data['sub_categories'] = SubCategory::where('status', 1)->get();
        $data['child_categories'] = ChildCategory::where('status', 1)->get();
        return view('backend.post.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'child_category_id' => 'required',
            'description' => 'required',
            'post_title' => 'required|unique:posts',
            'post_image' => 'required'

        ]);


        if ($validator->fails()) {
            $notification = array(
                'message' => 'Opps! Something went wrong .Please Try Again.',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);

        } else {

            $post = new Post();
            $post->category_id = $request->category_id;
            $post->sub_category_id = $request->sub_category_id;
            $post->child_category_id = $request->child_category_id;
            $post->post_title = $request->post_title;
            $post->post_title_slug = Str::slug($request->post_title);
            $post->description = $request->description;

            if ($request->file('post_image')) {
                $post_image = $request->file('post_image');
                $extension = $post_image->getClientOriginalExtension();
                $logo_name = "post_image" . time() . "." . $extension;
                $post_image->move(public_path('/uploads/post/'), $logo_name);
                $post->post_image = "/uploads/post/" . $logo_name;
            }

            $post->status = 1;
            $post->save();

            $notification = array(
                'message' => 'The new Post publish successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('post.index')->with($notification);

        }
    }

    public function edit($id)
    {
        $data['categories'] = Category::where('status', 1)->get();
        $data['sub_categories'] = SubCategory::where('status', 1)->get();
        $data['child_categories'] = ChildCategory::where('status', 1)->get();
        $data['post'] = Post::findOrFail($id);
        return view('backend.post.edit', $data);

    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'child_category_id' => 'required',
            'description' => 'required',
            'post_title' => 'required',

        ]);


        if ($validator->fails()) {
            $notification = array(
                'message' => 'Opps! Something went wrong .Please Try Again.',
                'alert-type' => 'error'
            );
            return redirect()->back()->withErrors($validator)->withInput()->with($notification);

        } else {
            $post = Post::findOrFail($id);
            $post->category_id = $request->category_id;
            $post->sub_category_id = $request->sub_category_id;
            $post->child_category_id = $request->child_category_id;
            $post->post_title = $request->post_title;
            $post->post_title_slug = Str::slug($request->post_title);
            $post->description = $request->description;

            if ($request->file('post_image')) {
                $image_path = public_path($post->post_image);
                if (file_exists($image_path)) {
                    @unlink($image_path);
                }
                $post_image = $request->file('post_image');
                $extension = $post_image->getClientOriginalExtension();
                $logo_name = "post_image" . time() . "." . $extension;
                $post_image->move(public_path('/uploads/post/'), $logo_name);
                $post->post_image = "/uploads/post/" . $logo_name;
            }

            $post->status = 1;
            $post->save();

            $notification = array(
                'message' => 'The Post Update publish successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('post.index')->with($notification);

        }
    }


    public function status($id)
    {
        $post = Post::findOrFail($id);
        if ($post->status == 1) {
            $post->status = 0;
        } else {
            $post->status = 1;
        }
        $post->save();

        $notification = array(
            'message' => 'The Post status update successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('post.index')->with($notification);
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $image_path = public_path($post->post_image);
        if (file_exists($image_path)) {
            @unlink($image_path);
        }

        $post->delete();
        $notification = array(
            'message' => 'The Post delete successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('post.index')->with($notification);
    }

    public function show($id)
    {
        $data['post'] = Post::findOrFail($id);
        $data['category'] = Category::where('id', $data['post']->category_id)->first();
        $data['sub_category'] = SubCategory::where('id', $data['post']->sub_category_id)->first();
        $data['child_category'] = ChildCategory::where('id', $data['post']->child_category_id)->first();

        return view('backend.post.show', $data);
    }

}
