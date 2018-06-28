<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
      parent::boot();

      static::creating(function($user){
        $user->activation_token = str_random(30);
      });
    }

    public function gravatar($size = '100'){
      $hash = md5(strtolower(trim($this->attributes['email'])));
      return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    public function sendPasswordResetNotification($token)
    {
      $this->notify(new ResetPassword($token));
    }

    public function statuses()
    {
      return $this->hasMany(Status::class);
      //因一個用戶擁有多個動態，因此用複數型態來定義函數名
    }

    public function feed()
    {
      $user_ids = Auth::user()->followings->pluck('id')->toArray();
      array_push($user_ids, Auth::user()->id);
      
      return Status::whereIn('user_id',$user_ids)
                  ->with('user')
                  ->orderBy('created_at','desc');
    }

    public function followers()
    {
      return $this->belongsToMany(User::Class, 'followers', 'user_id', 'follower_id');
      //第二個參數為自定義的關聯表名稱，default會是兩個關聯模型的名稱進行合併:user_user
      //第三個是定義在關聯中的模型外鍵名
      //第四個是要合併的模型外鍵名
      //透過 $user->followers 取得粉絲關係列表
    }

    public function followings()
    {
      return $this->belongsToMany(User::Class, 'followers', 'follower_id', 'user_id');
      //透過 $user->followings 取得用戶關注人列表
    }

    public function follow($user_ids)
    {
        if(!is_array($user_ids)){
          $user_ids = compact('user_ids');
        }
        //用is_array判斷數據是否為array，如果是則沒必要再使用compact方法
        $this->followings()->sync($user_ids, false);
    }

    public function unfollow($user_ids)
    {
        if(!is_array($user_ids)){
          $user_ids = compact($user_ids);
        }
        $this->followings()->detach($user_ids);
        //我們並沒有給syn&detach指定傳遞參數為用戶id，這兩個方法會自動獲取array中的id
    }

    public function isFollowing($user_id)
    {
      return $this->followings->contains($user_id);
      //$this->followings返回的是一個collections類的實例，也就是一個集合
      //contains方法是collection類的方法
      //而$this->followings()返回的是一個relations

      //1. $this->followings()返回的是一個hasMany對象
      //2. $this->followings返回一個collection集合
      //3. $this->followings()->get() 等於第二個
    }
}
