<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Validator;


class UserController extends Controller
{
    public function index()
    {
        return response()->json(['user' => auth()->user()], 200);
    }




    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->status = 1;
            $user->save();
            return response()->json([
                'message' => 'Your are Successfully Register!'
            ], 200);
        }


    }




    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);


    }



    public function logout(Request $request)
    {

        $token = $request->user()->token();
        $token->revoke();
        return response()->json([
            'message' => 'You are Successfully logged out'
        ]);


    }



    public function update(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $authuser = auth()->user();
        $user = User::find($authuser->id);
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->address = $request->address;
        //Image image
        $image = $request->file('image');
        if ($image) {
            $image_path = public_path($user->image);
            @unlink($image_path);
            $useImageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/user'), $useImageName);
            $user->image = '/uploads/user/' . $useImageName;
            $user->save();
        }
        $user->save();
        return response($user);

    }


    //Change Password
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);



        if (Auth::guard('web')->attempt(['id' => Auth::user()->id, 'password' => $request->current_password])) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json(['message' =>'Your password has been changed successfully.']);
        } else {

            return response()->json(['message' =>'Your new password does not match with old password.']);
        }
    }
}
