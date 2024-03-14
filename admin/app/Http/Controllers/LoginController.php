<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
class LoginController extends Controller
{
    //
    public function index(){
        return view('Login');
    }
    // public function onLogin(Request $req){
    //     dd('hello');
    //     $user = $req->input('user');
    //     $pass = $req->input('pass');

    //     $countUser = AdminModel::where('username', '=', $user)->where('password', '=', $pass)->count();
    //     if($countUser == 1 ) {
    //         return 1;
    //     }else {
    //         return 0;
    //     }
    // }

    public function onLogout(Request $req){
        $req->session()->flush();
        return redirect('/login');
    }

    public function onLogin(Request $req){
        $user = $req->input('user');
        $pass = $req->input('pass');

        $countUser = AdminModel::where('username', '=', $user)->where('password', '=', $pass)->count();
        if($countUser == 1) {
            $req->session()->put('user', $user);
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false], 401);
        }
    }

}
