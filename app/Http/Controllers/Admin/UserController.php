<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Order;

class UserController extends Controller
{
  // registerで行うため、user.addとcreateは不要
  
  // public function add()
  // {
  //   return view('admin.user.create');
  // }
  
  // public function create(Request $request)
  // {
  //   $this->validate($request, User::$rules);
    
  //   $user = new User;
  //   $form = $request->all();
    
  //   unset($form['_token']);
    
  //   $user->fill($form);
  //   $user->save();
    
  //   return redirect('/');
  //   //登録成否メッセージを入れる
  // }
  
  public function index(Request $request)
  {
    $where = '';
    $i = 0;
    
    // name
    if (isset($request->name)) {
      $query = sprintf("name LIKE '%%%s%%' ", $request->name);
      $where .= $query;
      $i++;
    }
    
    // status
    if (isset($request->status)) {
      if ($i) {
        $where .= ' and ';
      }
      $where .= sprintf("status = %s ", $request->status);
      $i++;
    }

    if ($i) {
      $users = User::whereRaw($where)->get();
    } else {
      $users = User::all();
    }
    
    $inputs = $request->all();
    return view('admin.user.index', ['users' => $users, 'inputs' => $inputs]);
  }
  
  // 7/20 修正
  public function show(Request $request)
  {
    $where = 'rental_machine_id = ' . $request->id;
    $i = 1;
    
    // status
    if (isset($request->status)) {
      if ($i) {
        $where .= ' and ';
      }
      $where .= sprintf("status = %s ", $request->status);
      $i++;
    }
    
    // out_date
    if (isset($request->out_date)) {
      if ($i) {
         $where .= ' and ';
      }
      $query = sprintf("CAST(out_date as CHAR) LIKE '%%%s%%' ", $request->out_date);
      $where .= $query;
      $i++;
    }
    
    // in_date
    if (isset($request->in_date)) {
      if ($i) {
         $where .= ' and ';
      }
      $query = sprintf("CAST(in_date as CHAR) LIKE '%%%s%%' ", $request->in_date);
      $where .= $query;
      $i++;
    }
    
    $orders = Order::whereRaw($where)->get();
    // dd($where);
    
    $user = User::find($request->id);
    $inputs = $request->all();
    return view('admin.user.show', ['user' => $user, 'orders' => $orders, 'inputs' => $inputs]);
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