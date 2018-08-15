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
        // 用户注册信息校验
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        //用户注册成功，存储用户信息
        $user = User::create([
            "name" =>$request->name,
            "email"=>$request->email,
            "password"=>bcrypt($request->password)
        ]);
        /**
         * session() 方法来访问会话实例。而当我们想存入一条缓存的数据，让它只在下一次的请求内有效时，
         * 则可以使用 flash 方法。flash 方法接收两个参数，第一个为会话的键，第二个为会话的值，我们可以通过下面这行代码的为会话赋值。
         *之后我们可以使用 session()->get('success') 通过键名来取出对应会话中的数据，取出的结果为 欢迎，您将在这里开启一段新的旅程~。    
        **/
        session()->flash('success','欢迎来到沙与沫，生命不息，装逼不止');

        /**
         * 注意这里是一个『约定优于配置』的体现，此时 $user 是 User 模型对象的实例。route() 方法会自动获取 Model 的主键，
         * 也就是数据表 users 的主键 id，以下代码等同于：
         * redirect()->route('users.show', [$user->id]);
         */
        return redirect()->route('users.show',[$user]);

    }
}
