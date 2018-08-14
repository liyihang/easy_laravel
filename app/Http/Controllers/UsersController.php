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
}
