<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    
  
    public function __construct()
    {
      $this->middleware('auth',[
        'except' => ['show','create','store','index']
      ]);

      $this->middleware('guest',[
        'only' => ['create']
        //只让未登录用户访问注册页面：
      ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // store 方法接受一個Illuminate\Http\Request實力參數
        // 我們可以使用它來獲得用戶的所有輸入數據
      
        $this->validate($request, [
          'name' => 'required|max:50',
          'email' => 'required|email|unique:users|max:255',
          'password' => 'required|confirmed|min:6'
        ]);

        // valiate 接受兩個參數，第一個為用戶的輸入數據，第二個是
        // 該輸入數據的驗證規則

        $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => bcrypt($request->password),
        ]);

        Auth::login($user);
        session()->flash('success','歡迎，您將在這裡展開一段新的旅程');
        // 我們可以使用session()方法來訪問會話實例›

        return redirect()->route('users.show', [$user]);
        // 注意这里是一个『约定优于配置』的体现，此时 $user 是 User 模型对象的实例。route() 方法会自动获取 Model 的主键，也就是数据表 users 的主键 id，以上代码等同于：
        // redirect()->route('users.show', [$user->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('updata', $user);
        return view('users.edit', compact('user'));
        //利用了 Laravel 的『隐性路由模型绑定』功能，直接读取对应 ID 的用户实例 $user，未找到则报错；
        //将查找到的用户实例 $user 与编辑视图进行绑定；
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request,[
          'name' => 'required|max:50',
          'password' => 'nullable|comfirmed|min:6'
        ]);

        $this->authorize('update', $user);
        //这里 update 是指授权类里的 update 授权方法，$user 对应传参 update 授权方法的第二个参数。
        //正如上面定义 update 授权方法时候提起的，调用时，默认情况下，我们不需要传递第一个参数，
        //也就是当前登录用户至该方法内，因为框架会自动加载当前登录用户。

        $data = [];
        $data['name'] = $request->name;
        if($request->password){
          $data['password'] = $request->bcrypt($request->password);
        }

        $user->update($data);
        session()->flash('success','個人資料更新成功！');

        return redirect()->route('users.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }
}
