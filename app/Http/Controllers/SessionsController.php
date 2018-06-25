<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
          'email' => 'required|email|max:255',
          'password' => 'required'
        ]);

        //我们可以看到，在 store 动作中的数据验证与之前的有所不同，
        //因为在这里只需要保证用户输入的值不为空且格式正确即可。用於验证失败时的错误提示。
        //当用户填写的信息验证通过之后，我们还需要对用户提供的信息进行用户身份认证，
        //因为验证通过只能说明用户提交的信息格式是正确的，并不能保证提交的用户信息存在于数据库中。

        if(Auth::attempt($credentials, $request->has('remember'))){
          //该用户存在于数据库，且邮箱和密码相符合
          session()->flash('success', '歡迎回來！');
          return redirect()->route('users.show', [Auth::user()]);
          // Auth::user() 方法可獲取當前登入用戶，並將用戶數據傳給路由
        } else {
          session()->flash('danger','很抱歉，您的Email與密碼不匹配');
          return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Auth::logout();
        session()->flash('success','您已成功登出！');

        return redirect('login');
    }
}
