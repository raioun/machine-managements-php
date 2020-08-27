<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Customer;

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
    
    // 顧客企業名の検索をこちらに入れる ↓に$where .= ' and ';は入れてある。
    
    if (isset($request->name)) {
      if ($i) {
         $where .= ' and ';
      }
      $query = sprintf("name LIKE '%%%s%%' ", $request->name);
      $where .= $query;
      $i++;
    }
    
    if ($i) {
      $projects = Project::whereRaw($where)->get();
    } else {
      $projects = Project::all();
    }
    
    // status要実装
    
    return view('admin.project.index', ['projects' => $projects]);
  }

  public function show(Request $request)
  {
    $project = Project::find($request->id);
    return view('admin.project.show', ['project' => $project]);
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
