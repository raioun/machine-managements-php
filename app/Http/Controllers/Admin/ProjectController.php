<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Customer;
use App\Order;

class ProjectController extends Controller
{
  public function add()
  {
    $customers = Customer::all();
    
    return view('admin.project.create', ['customers' => $customers]);
  }
  
  public function create(Request $request)
  {
    $this->validate($request, Project::$rules);
    
    $project = new Project;
    $form = $request->all();
    
    unset($form['_token']);
    
    $project->fill($form);
    $project->save();
    
    return redirect('/');
    //登録成否メッセージを入れる
  }
  
  public function index(Request $request)
  {
    $where = '';
    $i = 0;
    
    //customer_name
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
    
    //name
    if (isset($request->name)) {
      if ($i) {
         $where .= ' and ';
      }
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
      $projects = Project::whereRaw($where)->get();
    } else {
      $projects = Project::all();
    }
    
    $inputs = $request->all();
    return view('admin.project.index', ['projects' => $projects, 'inputs' => $inputs]);
  }

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
    
    
    $project = Project::find($request->id);
    $inputs = $request->all();
    return view('admin.project.show', ['project' => $project, 'orders' => $orders, 'inputs' => $inputs]);
  }
  
  public function edit(Request $request)
  {
    $customers = Customer::all();
    
    $project = Project::find($request->id);
    if (empty($project)) {
      abort(404);
    }
    return view('admin.project.edit', ['project' => $project, 'customers' => $customers]);
  }
  
  public function update(Request $request)
  {
    $this->validate($request, Project::$rules);
    
    $project = Project::find($request->id);
    
    $form = $request->all();
    unset($form['_token']);
    
    $project->fill($form)->save();
    
    // 8/8(土)作成 web.php(routing)で命名したshow_projectからページを取得する redirectする時にパラメータを渡す方法
    return redirect(route('show_project', ['id' => $request->id]));
  }
}
