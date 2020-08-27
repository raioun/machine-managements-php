<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RentalMachine;
use App\Machine;
use App\Branch;
use App\Storage;
use App\Company; //必要？

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
    
    // machine->name, machine->type1, machine->type2 要実装 ↓に$where .= ' and ';は記述済み。
    
    if (isset($request->code)) {
      if ($i) {
         $where .= ' and ';
      }
      // code はあいまい検索にしない方が良いのでは？
      $query = sprintf("code LIKE '%%%s%%' ", $request->code);
      $where .= $query;
      $i++;
    }
    
    // 所有企業名、営業所名、保管企業名、保管営業所名、status要実装
    
    if ($i) {
      $rental_machines = RentalMachine::whereRaw($where)->get();
    } else {
      $rental_machines = RentalMachine::all();
    }
    
    return view('admin.rental_machine.index', ['rental_machines' => $rental_machines]);
  }
  
  // 7/20 修正
  public function show(Request $request)
  {
    $rental_machine = RentalMachine::find($request->id);
    return view('admin.rental_machine.show', ['rental_machine' => $rental_machine]);
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
