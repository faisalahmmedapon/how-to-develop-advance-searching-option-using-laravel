<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('backend.user.index', compact('users'));
    }

    public function status($id)
    {
        $user = User::findOrFail($id);
        if ($user->status == 1) {
            $user->status = 0;
        } else {
            $user->status = 1;
        }
        $user->save();

        $notification = array(
            'message' => 'The User status update successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.index')->with($notification);
    }


    public function delete($id)
    {
        $user = User::findOrFail($id);
        $image_path = public_path($user->image);
        if (file_exists($image_path)) {
            @unlink($image_path);
        }

        $user->delete();
        $notification = array(
            'message' => 'The User delete successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.index')->with($notification);
    }



}
