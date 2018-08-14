<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * 用戶顯示
     */
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }
    /**
     * 用戶創建頁面
     */
    public function create()
    {
        
        return view('users.create');
    }
    /**
     * 用户校验注册页面
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|min:6|max:32',
            'email'=>'required|email|unique:users|max:255',
            'password'=>'required|confirmed|min:6'
        ]);

    }
}
