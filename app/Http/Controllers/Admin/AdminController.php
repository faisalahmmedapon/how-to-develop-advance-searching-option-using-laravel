<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Hash;
use Session;

class AdminController extends Controller
{
    public function login(){
        return view('backend.admin.login');
    }


    public function adminLogin(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required|min:5|max:10',
        ]);

        $admin = Admin::where('email' , '=', $request->email)->first();
        if ($admin){
            if (Hash::check($request->password,$admin->password)){
                $request->session()->put('adminId',$admin->id);
                return redirect('/dashboard');
            }else{
                return redirect()->back()->with('error','Password not match ');
            }

            //return redirect()->back()->with('success','We got your gmail '.$request->email);
        }else{
            return redirect()->back()->with('error','oh sorry we not found any '.$request->email . 'in our database');
        }

    }





    public function register(){
        return view('backend.admin.register');
    }

    public function adminRegister(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:admins',
            'password' => 'required|min:5|max:10',
        ]);


        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $result =  $admin->save();
        if ($result){
            return redirect()->back()->with('success','You have register successfully');
        }else{
            return redirect()->back()->with('error','You have not register perfectly');
        }

    }



    public function dashboard(){
        $data = array();
        if (Session::has('adminId')){
            $data = Admin::where('id','=',Session::get('adminId'))->first();
        }
        return view('backend.dashboard.dashboard',compact('data'));
    }
    public function logout(){
        if (Session::has('adminId')){
            Session::pull('adminId');
            return redirect('/admin/login');
        }
    }
}
