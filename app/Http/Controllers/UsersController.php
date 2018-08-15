<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Auth\Access\AuthorizationException;

class UsersController extends Controller
{

    
    /**
     * 权限控制
     * 我们在 __construct 方法中调用了 middleware 方法，该方法接收两个参数，
     * 第一个为中间件的名称，第二个为要进行过滤的动作。
     * 我们通过 except 方法来设定 指定动作 不使用 Auth 中间件进行过滤，意为 —— 除了此处指定的动作以外，
     * 所有其他动作都必须登录用户才能访问，类似于黑名单的过滤机制。
     * 
     */
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>['create','store']
        ]);
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

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
         *之后我们可以使用 session()->get('success') 通过键名来取出对应会话中的数据，取出的结果为 "xxxxxx"~。    
        **/
        Auth::login($user);
        session()->flash('success','欢迎来到沙与沫，生命不息，装逼不止');

        /**
         * 注意这里是一个『约定优于配置』的体现，此时 $user 是 User 模型对象的实例。route() 方法会自动获取 Model 的主键，
         * 也就是数据表 users 的主键 id，以下代码等同于：
         * redirect()->route('users.show', [$user->id]);
         */
        return redirect()->route('users.show',[$user]);

    }

    // 用户信息的编辑
    public function edit(User $user)
    {
        // 验证用户授权策略  继承自Controllers 里的AuthorizesRequests trait 里面
        try{

            $this->authorize('update',$user);

        }catch(AuthorizationException $e){
            return abort(403, '无权访问');
        }

        return view('users.edit',compact('user'));
    }

    // 用户信息编辑
    // 第一个为自动解析用户 id 对应的用户实例对象，
    // 第二个则为更新用户表单的输入数据。在我们接收到用户提交的信息时，
    // 需要先对用户提交的信息进行验证，最终调用 update 方法对用户对象进行更新。
    // 在用户个人资料更新成功后，我们还需要将用户重定向到个人页面，方便用户第一时间查看到自己更改后的个人信息。
    public function update(User $user,Requeset $request)
    {
        $this->validate($request,[
            'name'=>'required|max:32',
            'password'=>'nullable|confirmed|min:6'
        ]);

        //通edit的一样  验证用户授权策略

        try {
            $this->authorize('update', $user);
        } catch (AuthorizationException $e) {
            return abort(403, '无权访问');
        }

        //用户密码验证的 required 规则换成 nullable，这意味着当用户提供空白密码时也会通过验证，
        //因此我们需要对传入的 password 进行判断，当其值不为空时才将其赋值给 data

        // $this->update([
        //     'name'=>$request->name,
        //     'password'=>bcrypt($request->password),
        // ]);

        $data = [];
        $data['name'] = $request->name;
        if($request->password)
        {
            $data['password'] = bcrypt($request->password);

        }
        
        $this->update($data);
        session()->flash('success','信息更新成功');
        return redirect()->route('users.show',$user->id);

    }
}
