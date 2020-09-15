<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer; //これ入れ忘れないように
use App\Orderer;
use App\Project;

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
    
    $inputs = $request->all();
    return view('admin.customer.index', ['customers' => $customers, 'inputs' => $inputs]);
  }
  
  // 7/20 修正
  public function show(Request $request)
  {
    // orderer
    $orderer_where = 'customer_id = ' . $request->id;
    $i = 1;
    
    // orderer_status
    if (isset($request->orderer_status)) {
      if ($i) {
        $orderer_where .= ' and ';
      }
      $orderer_where .= sprintf("status = %s ", $request->orderer_status);
      $i++;
    }
    
    // family_name
    if (isset($request->family_name)) {
      if ($i) {
         $orderer_where .= ' and ';
      }
      $query = sprintf("family_name LIKE '%%%s%%' ", $request->family_name);
      $orderer_where .= $query;
      $i++;
    }
    
    //project
    $project_where = 'customer_id = ' . $request->id;
    $i = 1;
    
    // project_status
    if (isset($request->project_status)) {
      if ($i) {
        $project_where .= ' and ';
      }
      $project_where .= sprintf("status = %s ", $request->project_status);
      $i++;
    }
    
    // project_name
    if (isset($request->project_name)) {
      if ($i) {
         $project_where .= ' and ';
      }
      $query = sprintf("name LIKE '%%%s%%' ", $request->project_name);
      $project_where .= $query;
      $i++;
    }
    // var_dump($orderer_where);
    // dd($project_where);

    $orderers = Orderer::whereRaw($orderer_where)->get();
    $projects = Project::whereRaw($project_where)->get();
    
    $customer = Customer::find($request->id);
    $inputs = $request->all();
    return view('admin.customer.show', ['customer' => $customer, 'orderers' => $orderers, 'projects' => $projects, 'inputs' => $inputs]);
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
