<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    function viewuser()
    {
        $titleheader = "Tài khoản";
        $boxtitle = "Quản lý tài khoản";
        $Users = User::all();
        return View('backend.page.user', compact('titleheader', 'boxtitle', 'Users'));
    }

    public function AddUser(){
        $titleheader = "Tài khoản";
        $boxtitle = "Thêm tài khoảng";
        Session::put('message', 'Thêm tài khoảng thành công');
        return View('backend.page.add_user', compact('titleheader', 'boxtitle'));
    }
    public function SubmitAddUser(Request $req){
        User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
        ]);

        return Redirect::to('viewuser');
    }

    public function DeleteUser($id){
        User::destroy($id);
        Session::put('message', 'Xóa thành công');
        return Redirect::to('viewuser');
    }
}
