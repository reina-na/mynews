<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;

class ProfileController extends Controller
{
    //
    public function add()
    {
       return view('admin.profile.create');
    }

    /*public function edit()
    {
       return view('admin.profile.edit');
    }

    public function update()
    {
        return redirect('admin/profile/edit');
    }*/
    
    public function create(Request $request)
    {
     //Varidationを行う
      $this->validate($request,Profile::$rules);
      
      $profile = new Profile();
      $form = $request->all();
      
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      
      // データベースに保存する
      $profile->fill($form);
      $profile->save();
      
      // admin/profile/createにリダイレクトする
      return redirect('admin/profile/create');
      
    }
    
    
    //PHP16
    public function index(Request $request)
    {
        $cond_profile = $request->cond_profile;
        if ($cond_profile != ''){
            //検索されたら検索結果を取得する
            $posts = Profile::where('profile',$cond_profile)->get();
            } else {
                //それ以外はすべてのニュースを取得する
                $posts = Profile::all();
            }
            return view('admin.profile.index',['posts'=>$posts,
                                            'cond_profile'=>$cond_profile]);
    }
    
    public function edit(Request $request)
    {
        $profile = Profile::find($request->id);
        if (empty ($profile)) {
            abort (404);
        }
        return view('admin.profile.edit',['profile_form' => $profile]);
    }
    
    public function update(Request $request)
    {
        //Validationをかける
        $this->validate($request,Profile::$rules);
         // News Modelからデータを取得する
         $profile = Profile::find($request->id);
         // 送信されてきたフォームデータを格納する
         $profile_form = $request -> all();
         //エラーにならずに画像を変更
         if ($request->remove == 'true'){
             $profile_form['image_path'] = null;
         } elseif ($request->file('image')){
             $path = $request->file('image')->store('public/image');
             $profile_form['image_path'] = basename($path);
         } else {
             $profile_form['image_path'] = $profile->image_path;
         }
         
         unset($profile_form['image']);
         unset($profile_form['remove']);
         unset($profile_form['_token']);
         // 該当するデータを上書きして保存する
         $profile->fill($profile_form)->save();
         return redirect('admin/profile');
    }
    
    public function delete(Request $request)
    {
        // 該当するprofile Modelを取得
        $profile = Profile::find($request->id);
        // 削除する
        $profile->delete();
        return redirect('admin/profile/');
    }
}