<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Branch;
use App\Company;
use App\RentalMachine;
use App\Machine;

class BranchController extends Controller
{
  public function add()
  {
    $companies = Company::all();
    
    return view('admin.branch.create', ['companies' => $companies]);
  }
  
  public function create(Request $request)
  {
    $this->validate($request, Branch::$rules);
    
    $branch = new Branch;
    $form = $request->all();
    
    unset($form['_token']);
    
    $branch->fill($form);
    $branch->save();
    
    return redirect('/');
    //登録成否メッセージを入れる 
  }
  
  public function index(Request $request)
  {
    
    $where = '';
    $i = 0;

    if (isset($request->company_name)) {
      $companies = Company::where('name', 'LIKE', "%$request->company_name%")->get();
      
      $query = '(';
      foreach($companies as $company) {
        $query .= $query == '(' ? '' : 'or ';
        $query .= sprintf("company_id = %s ", $company->id);
      }
      $query .= ')';
      
      $where .= $query;
      $i++;
    }
    
    if (isset($request->name)) {
      if ($i) {
         $where .= ' and ';
      }
      $query = sprintf("name LIKE '%%%s%%' ", $request->name);
      $where .= $query;
      $i++;
    }
    
    if ($i) {
      $branches = Branch::whereRaw($where)->get();
    } else {
      $branches = Branch::all();
    }
    
    $inputs = $request->all();
    return view('admin.branch.index', ['branches' => $branches, 'inputs' => $inputs]);
  }

  public function show(Request $request)
  {
    $where = 'branch_id = ' . $request->id;
    $i = 1;
    
    // status
    if (isset($request->status)) {
      if ($i) {
        $where .= ' and ';
      }
      $where .= sprintf("status = %s ", $request->status);
      $i++;
    }

    // rental_machine->machine->name
    if (isset($request->machine_name)) {
      $machines = Machine::where('name', 'LIKE', "%$request->machine_name%")->get();
      // dd($machines);
      $rental_machines = [];
      foreach($machines as $machine) {
        $tmp = RentalMachine::where('machine_id', $machine->id)->get()->all();
        // dd($tmp);
        $rental_machines = array_merge($rental_machines, $tmp);
      }
      // dd($rental_machines);
      $query = '(';
      foreach($rental_machines as $rental_machine) {
        // 三項演算子  　条件式 ? 式1 : 式2 ;
        $query .= $query == '(' ? '' : 'or ';
        // 置換文字 %s　後に記載されている引数(今回の場合は$machine->id)を%sに代入する。
        $query .= sprintf("machine_id = %s ", $rental_machine->machine_id);
      }
      $query .= ')';
      // dd($query);
      if ($i) {
         $where .= ' and ';
      }
      $where .= $query;
      $i++;
    }

    // rental_machine->machine->type1
    if (isset($request->machine_type1)) {
      $machines = Machine::where('type1', 'LIKE', "%$request->machine_type1%")->get();
      $rental_machines = [];
      foreach($machines as $machine) {
        $tmp = RentalMachine::where('machine_id', $machine->id)->get()->all();
        $rental_machines = array_merge($rental_machines, $tmp);
      }
      $query = '(';
      foreach($rental_machines as $rental_machine) {
        $query .= $query == '(' ? '' : 'or ';
        $query .= sprintf("machine_id = %s ", $rental_machine->machine_id);
      }
      $query .= ')';
      if ($i) {
         $where .= ' and ';
      }
      $where .= $query;
      $i++;
    }
    
    // rental_machine->machine->type2
    if (isset($request->machine_type2)) {
      $machines = Machine::where('type2', 'LIKE', "%$request->machine_type2%")->get();
      $rental_machines = [];
      foreach($machines as $machine) {
        $tmp = RentalMachine::where('machine_id', $machine->id)->get()->all();
        $rental_machines = array_merge($rental_machines, $tmp);
      }
      $query = '(';
      foreach($rental_machines as $rental_machine) {
        $query .= $query == '(' ? '' : 'or ';
        $query .= sprintf("machine_id = %s ", $rental_machine->machine_id);
      }
      $query .= ')';
      if ($i) {
         $where .= ' and ';
      }
      $where .= $query;
      $i++;
    }
    
    // code
    if (isset($request->code)) {
      if ($i) {
         $where .= ' and ';
      }
      $query = sprintf("code LIKE '%%%s%%' ", $request->code);
      $where .= $query;
      $i++;
    }
    
    $rental_machines = RentalMachine::whereRaw($where)->get();
    
    $branch = Branch::find($request->id);
    $inputs = $request->all();
    return view('admin.branch.show', ['branch' => $branch, 'rental_machines' => $rental_machines, 'inputs' => $inputs]);
  }
  
  public function edit(Request $request)
  {
    $companies = Company::all();
    
    $branch = Branch::find($request->id);
    if (empty($branch)) {
      abort(404);
    }
    return view('admin.branch.edit', ['branch' => $branch, 'companies'=>$companies]);
  }
  
  public function update(Request $request)
  {
    $this->validate($request, Branch::$rules);
    
    $branch = Branch::find($request->id);
    
    $form = $request->all();
    unset($form['_token']);
    
    $branch->fill($form)->save();
    
    // 8/8(土)作成 web.php(routing)で命名したshow_branchからページを取得する redirectする時にパラメータを渡す方法
    return redirect(route('show_branch', ['id' => $request->id]));
  }
}