<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Orderer; //ここ忘れずに入れる
use App\Customer; //連結modelの記載も忘れずに

class OrdererController extends Controller
{
  public function add()
  {
    $customers = Customer::all();
    
    //　8/3(月)追加 createのcustomer->name一覧を出す際に使用
    return view('admin.orderer.create', ['customers' => $customers]);
  
  }
  
  public function create(Request $request)
  {
    // dd($request);
    $this->validate($request, Orderer::$rules);
    
    $orderer = new Orderer;
    $form = $request->all();
    // dd($form);
    
    unset($form['_token']);
    
    $orderer->fill($form);
    $orderer->save();
    
    return redirect('/');
    //登録成否メッセージを入れる
  }
  
  public function index(Request $request)
  {
    $where = '';
    $i = 0;
    
    // 顧客企業名の検索をこちらに入れる ↓に$where .= ' and ';は入れてある。
    
    if (isset($request->family_name)) {
      if ($i) {
         $where .= ' and ';
      }
      $query = sprintf("family_name LIKE '%%%s%%' ", $request->family_name);
      $where .= $query;
      $i++;
    }
    
    // status要実装
    
    if ($i) {
      $orderers = Orderer::whereRaw($where)->get();
    } else {
      $orderers = Orderer::all();
    }
    
    return view('admin.orderer.index', ['orderers' => $orderers]);
  }
  
  // 7/20 修正
  public function show(Request $request)
  {
    $orderer = Orderer::find($request->id);
    return view('admin.orderer.show', ['orderer' => $orderer]);
  }
  
  public function edit(Request $request)
  {
    $customers = Customer::all();
    
    $orderer = Orderer::find($request->id);
    if (empty($orderer)) {
      abort(404);
    }
    return view('admin.orderer.edit', ['orderer' => $orderer, 'customers' => $customers]);
  }
  
  public function update(Request $request)
  {
    // dd($request);
    $this->validate($request, Orderer::$rules);
    
    $orderer = Orderer::find($request->id);
  
    $form = $request->all();
    // dd($form);
    unset($form['_token']);
    
    $orderer->fill($form)->save();
    
    // 8/8(土)作成 web.php(routing)で命名したshow_ordererからページを取得する redirectする時にパラメータを渡す方法
    return redirect(route('show_orderer', ['id' => $request->id]));
  }
}