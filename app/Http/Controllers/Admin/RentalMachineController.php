<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RentalMachine;
use App\Machine;
use App\Branch;
use App\Storage;
use App\Company; //必要？
use App\Order;

class RentalMachineController extends Controller
{
  public function add()
  {
    $machines = Machine::all();
    $branches = Branch::all();
    $storages = Storage::all();
    $companies = Company::all();
    
    return view('admin.rental_machine.create', ['machines' => $machines, 'branches' => $branches, 'storages' => $storages, 'companies' => $companies]);
  }
  
  public function create(Request $request)
  {
    $this->validate($request, RentalMachine::$rules);
    
    $rental_machine = new RentalMachine;
    $form = $request->all();
    
    unset($form['_token']);
    
    $rental_machine->fill($form);
    $rental_machine->save();
    
    return redirect('/');
    //登録成否メッセージを入れる
  }
  
  public function index(Request $request)
  {
    $where = '';
    $i = 0;
    
    if (isset($request->machine_name)) {
      $machines = Machine::where('name', 'LIKE', "%$request->machine_name%")->get();
      
      $query = '(';
      foreach($machines as $machine) {
        $query .= $query == '(' ? '' : 'or ';
        $query .= sprintf("machine_id = %s ", $machine->id);
      }
      $query .= ')';
      
      $where .= $query;
      $i++;
    }
        
    if (isset($request->machine_type1)) {
      $machines = Machine::where('type1', 'LIKE', "%$request->machine_type1%")->get();
      
      $query = '(';
      foreach($machines as $machine) {
        $query .= $query == '(' ? '' : 'or ';
        $query .= sprintf("machine_id = %s ", $machine->id);
      }
      $query .= ')';
      
      if ($i) {
        $where .= ' and ';
      }
      $where .= $query;
      $i++;
    }
        
    if (isset($request->machine_type2)) {
      $machines = Machine::where('type2', 'LIKE', "%$request->machine_type2%")->get();
      
      $query = '(';
      foreach($machines as $machine) {
        $query .= $query == '(' ? '' : 'or ';
        $query .= sprintf("machine_id = %s ", $machine->id);
      }
      $query .= ')';
      
      if ($i) {
        $where .= ' and ';
      }
      $where .= $query;
      $i++;
    }

    if (isset($request->code)) {
      if ($i) {
         $where .= ' and ';
      }
      // code はあいまい検索にしない方が良いのでは？
      $query = sprintf("code LIKE '%%%s%%' ", $request->code);
      $where .= $query;
      $i++;
    }
    
    // 所有企業名、要実装 branch_company_name
    if (isset($request->branch_company_name)) {
      $companies = Company::where('name', 'LIKE', "%$request->branch_company_name%")->get();
      $branches = [];
      foreach($companies as $company) {
        $tmp = Branch::where('company_id', $company->id)->get()->all();
        $branches = array_merge($branches, $tmp);
      }
      $query = '(';
      foreach($branches as $branch) {
        $query .= $query == '(' ? '' : 'or ';
        $query .= sprintf("branch_id = %s ", $branch->id);
      }
      $query .= ')';
      if ($i) {
         $where .= ' and ';
      }
      $where .= $query;
      $i++;
    }
    
    if (isset($request->branch_name)) {
      $branches = Branch::where('name', 'LIKE', "%$request->branch_name%")->get();
      
      $query = '(';
      foreach($branches as $branche) {
        $query .= $query == '(' ? '' : 'or ';
        $query .= sprintf("branch_id = %s ", $branche->id);
      }
      $query .= ')';
      
      if ($i) {
        $where .= ' and ';
      }
      $where .= $query;
      $i++;
    }
    
    // 保管企業名、要実装 storage_company_name
    if (isset($request->storage_company_name)) {
      $companies = Company::where('name', 'LIKE', "%$request->storage_company_name%")->get();
      $storages = [];
      foreach($companies as $company) {
        $tmp = Branch::where('company_id', $company->id)->get()->all();
        $storages = array_merge($storages, $tmp);
      }
      $query = '(';
      foreach($storages as $storage) {
        $query .= $query == '(' ? '' : 'or ';
        $query .= sprintf("storage_id = %s ", $storage->id);
      }
      $query .= ')';
      if ($i) {
         $where .= ' and ';
      }
      $where .= $query;
      $i++;
    }

    if (isset($request->storage_name)) {
      $storages = Storage::where('name', 'LIKE', "%$request->storage_name%")->get();
      
      $query = '(';
      foreach($storages as $storage) {
        $query .= $query == '(' ? '' : 'or ';
        $query .= sprintf("storage_id = %s ", $storage->id);
      }
      $query .= ')';
      
      if ($i) {
        $where .= ' and ';
      }
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
      $rental_machines = RentalMachine::whereRaw($where)->get();
    } else {
      $rental_machines = RentalMachine::all();
    }
    
    $inputs = $request->all();
    return view('admin.rental_machine.index', ['rental_machines' => $rental_machines, 'inputs' => $inputs]);
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
    
    $rental_machine = RentalMachine::find($request->id);
    $inputs = $request->all();
    return view('admin.rental_machine.show', ['rental_machine' => $rental_machine, 'orders' => $orders, 'inputs' => $inputs]);
  }
  
  public function edit(Request $request)
  {
    $machines = Machine::all();
    $branches = Branch::all();
    $storages = Storage::all();
    $companies = Company::all();
    
    $rental_machine = RentalMachine::find($request->id);
    if (empty($rental_machine)) {
      abort(404);
    }
    return view('admin.rental_machine.edit', ['rental_machine' => $rental_machine, 'machines' => $machines, 'branches' => $branches, 'storages' => $storages, 'companies' => $companies]);
  }
  
  public function update(Request $request)
  {
    $this->validate($request, RentalMachine::$rules);
    
    $rental_machine = RentalMachine::find($request->id);
  
    $form = $request->all();
    unset($form['_token']);
    
    $rental_machine->fill($form)->save();
    
    // 8/8(土)作成 web.php(routing)で命名したshow_rental_machineからページを取得する redirectする時にパラメータを渡す方法
    return redirect(route('show_rental_machine', ['id' => $request->id]));
  }
}
