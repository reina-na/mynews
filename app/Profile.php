<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = array('id');
    //データ異常を見つけた場合データを保存せずに入力フォームへ戻す
    public static $rules = array(
        'name' => 'required',
        'gender' => 'required',
        'hobby' => 'required',
        'introduction' => 'required',
        );
        
    // News Modelに関連付けを行う
    public function profilehistories()
    {
        return $this->hasMany('App\Profilehistory');

    }
}
