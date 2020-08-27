<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer; //これ入れ忘れないように

class CustomerController extends Controller
{
  public function add()
  {
    return view('admin.customer.create');
  }
  
  public function create(Request $request)
  {
    $this->validate($request, Customer::$rules);
    
    $customer = new Customer;
    $form = $request->all();
    
    unset($form['_token']);
    
    $customer->fill($form);
    $customer->save();
    
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
    
    if ($i) {
      $customers = Customer::whereRaw($where)->get();
    } else {
      $customers = Customer::all();
    }
    
    return view('admin.customer.index', ['customers' => $customers]);
  }
  
  // 7/20 修正
  public function show(Request $request)
  {
    $customer = Customer::find($request->id);
    return view('admin.customer.show', ['customer' => $customer]);
  }
  
  
  public function edit(Request $request)
  {
    $customer = Customer::find($request->id);
    if (empty($customer)) {
      abort(404);
    }
    return view('admin.customer.edit', ['customer' => $customer]);
  }
  
  public function update(Request $request)
  {
    $this->validate($request, Customer::$rules);
    
    $customer = Customer::find($request->id);
  
    $form = $request->all();
    unset($form['_token']);
    
    $customer->fill($form)->save();
    
    // 8/8(土)作成 web.php(routing)で命名したshow_customerからページを取得する redirectする時にパラメータを渡す方法
    return redirect(route('show_customer', ['id' => $request->id]));
  }
}
