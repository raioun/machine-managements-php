<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Orderer; //ここ忘れずに入れる
use App\Customer; //連結modelの記載も忘れずに
use App\Order;

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
    
    if (isset($request->customer_name)) {
      $customers = Customer::where('name', 'LIKE', "%$request->customer_name%")->get();
      
      $query = '(';
      foreach($customers as $customer) {
        $query .= $query == '(' ? '' : 'or ';
        $query .= sprintf("customer_id = %s ", $customer->id);
      }
      $query .= ')';
      
      $where .= $query;
      $i++;
    }

    if (isset($request->family_name)) {
      if ($i) {
         $where .= ' and ';
      }
      $query = sprintf("family_name LIKE '%%%s%%' ", $request->family_name);
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
      $orderers = Orderer::whereRaw($where)->get();
    } else {
      $orderers = Orderer::all();
    }
    
    $inputs = $request->all();
    return view('admin.orderer.index', ['orderers' => $orderers, 'inputs' => $inputs]);
  }
  
  // 7/20 修正
  public function show(Request $request)
  {
    $where = 'rental_machine_id = ' . $request->id;
    $i = 1;
    
    // status
    if (isset($request->order_status)) {
      if ($i) {
        $where .= ' and ';
      }
      $where .= sprintf("status = %s ", $request->order_status);
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
    
    $orderer = Orderer::find($request->id);
    $inputs = $request->all();
    return view('admin.orderer.show', ['orderer' => $orderer, 'orders' => $orders, 'inputs' => $inputs]);
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