<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;

class AdminController extends Controller
{
    public function login(){
        return view('backEnd.login');
    }

    // Login
    public function submit_login(Request $request){
        $request->validate([
            'username' => 'required|min:3|max:20',
            'password' => 'required|min:5',
        ]);
        $checked = Admin::where(['username' => $request->username, 'password' => $request->password])->count();
        if($checked > 0){
            $adminData = Admin::where(['username' => $request->username, 'password' => $request->password])->count();
            session(['adminData' => $adminData]);
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->back()->with('error', 'Invalid usernme or password');
        }
    }

    public function dashboard(){
        return view('backEnd.originalDashboard');
    }

    //Logout
    Public function logout(){
        session()->forget(['adminData']);
        return redirect()->route('admin.login');
    }

    // Users
    public function getUsers(){
        $users = User::all();
        return view('backEnd.users.index', compact('users'));
    }

    //delete User
    public function destroy($id){
        User::where('id', $id)->delete();
        return redirect()->route('admin.user')->with('success', 'User successfully deleted!');
    }
}
