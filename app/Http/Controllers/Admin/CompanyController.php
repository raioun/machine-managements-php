<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;

class CompanyController extends Controller
{
  public function add()
  {
    return view('admin.company.create');
  }
  
  public function create(Request $request)
  {
    $this->validate($request, Company::$rules);
    
    $company = new Company;
    $form = $request->all();
    
    unset($form['_token']);
    
    $company->fill($form);
    $company->save();
    
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
      $companies = Company::whereRaw($where)->get();
    } else {
      $companies = Company::all();
    }
    
    return view('admin.company.index', ['companies' => $companies]);
  }

  public function show(Request $request)
  {
    $company = Company::find($request->id);
    return view('admin.company.show', ['company' => $company]);
  }
  
  public function edit(Request $request)
  {
    $company = Company::find($request->id);
    if (empty($company)) {
      abort(404);
    }
    return view('admin.company.edit', ['company' => $company]);
  }
  
  public function update(Request $request)
  {
    $this->validate($request, Company::$rules);
    
    $company = Company::find($request->id);
  
    $form = $request->all();
    unset($form['_token']);
    
    $company->fill($form)->save();
    
    
    // 8/8(土)作成 web.php(routing)で命名したshow_companyからページを取得する redirectする時にパラメータを渡す方法
    return redirect(route('show_company', ['id' => $request->id]));
  }
}
