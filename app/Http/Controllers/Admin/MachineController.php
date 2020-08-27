<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Machine;

class MachineController extends Controller
{
  public function add()
  {
    return view('admin.machine.create');
  }
  
  public function create(Request $request)
  {
    $this->validate($request, Machine::$rules);
    
    $machine = new Machine;
    $form = $request->all();
    
    unset($form['_token']);
    
    $machine->fill($form);
    $machine->save();
          
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
    
    if (isset($request->type1)) {
      if ($i) {
         $where .= ' and ';
      }
      $query = sprintf("type1 LIKE '%%%s%%' ", $request->type1);
      $where .= $query;
      $i++;
    }
    
    if (isset($request->type2)) {
      if ($i) {
         $where .= ' and ';
      }
      $query = sprintf("type2 LIKE '%%%s%%' ", $request->type2);
      $where .= $query;
      $i++;
    }
    
    if ($i) {
      $machines = Machine::whereRaw($where)->get();
    } else {
      $machines = Machine::all();
    }
    
    return view('admin.machine.index', ['machines' => $machines]);
  }
  
  public function show(Request $request)
  {
    $machine = Machine::find($request->id);
    return view('admin.machine.show', ['machine' => $machine]);
  }
  
  // public function edit(Request $request)
  // {
  //    return view('admin.machine.edit');
  // }
  
  // public function update(Request $request)
  // {
  //    return redirect('admin/machines');
  // }
}
