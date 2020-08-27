<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
  public function add()
  {
    return view('admin.user.create');
  }
  
  public function create(Request $request)
  {
    $this->validate($request, User::$rules);
    
    $user = new User;
    $form = $request->all();
    
    unset($form['_token']);
    
    $user->fill($form);
    $user->save();
    
    return redirect('/');
    //登録成否メッセージを入れる
  }
  
  public function index(Request $request)
  {
    $where = '';
    $i = 0;
    if (isset($request->name)) {
      $query = sprintf("name LIKE '%%%s%%' ", $request->name);
      $where .= $query;
      $i++;
    }
    
    // 実装中
    if (isset($request->status)) {
      if ($i) {
         $where .= ' and ';
      }
      $query = sprintf("status", $request->status);
      $where .= $query;
      $i++;
    }

    if ($i) {
      $users = User::whereRaw($where)->get();
    } else {
      $users = User::all();
    }
    
    return view('admin.user.index', ['users' => $users]);
  }
  
  // 7/20 修正
  public function show(Request $request)
  {
    $user = User::find($request->id);
    return view('admin.user.show', ['user' => $user]);
  }
  
  public function edit(Request $request)
  {
    $user = User::find($request->id);
    if (empty($user)) {
      abort(404);
    }
    return view('admin.user.edit', ['user' => $user]);
  }
  
  public function update(Request $request)
  {
    $this->validate($request, User::$rules);
    
    $user = User::find($request->id);
  
    $form = $request->all();
    // dd($form);
    unset($form['_token']);
    
    $user->fill($form);
    // dd($user->status);
    $user->save();
    
    // 8/8(土)作成 web.php(routing)で命名したshow_userからページを取得する redirectする時にパラメータを渡す方法
    return redirect(route('show_user', ['id' => $request->id]));
  }
}