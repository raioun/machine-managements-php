<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Branch;
use App\Company;

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
    
    return view('admin.branch.index', ['branches' => $branches]);
  }

  public function show(Request $request)
  {
    $branch = Branch::find($request->id);
    return view('admin.branch.show', ['branch' => $branch]);
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