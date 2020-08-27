<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Storage;
use App\Company;

class StorageController extends Controller
{
  public function add()
  {
    $companies = Company::all();
    
    return view('admin.storage.create', ['companies' => $companies]);
  }
  
  public function create(Request $request)
  {
    $this->validate($request, Storage::$rules);
    
    $storage = new Storage;
    $form = $request->all();
    
    unset($form['_token']);
    
    $storage->fill($form);
    $storage->save();
    
    return redirect('/');
    //登録成否メッセージを入れる 
  }
  
  public function index(Request $request)
  {
    $storages = Storage::all();
    return view('admin.storage.index', ['storages' => $storages]);
  }

  public function show(Request $request)
  {
    $storage = Storage::find($request->id);
    return view('admin.storage.show', ['storage' => $storage]);
  }
  
  public function edit(Request $request)
  {
    $companies = Company::all();
    
    $storage = Storage::find($request->id);
    if (empty($storage)) {
      abort(404);
    }
    return view('admin.storage.edit', ['storage' => $storage, 'companies' => $companies]);
  }
  
  public function update(Request $request)
  {
    $this->validate($request, Storage::$rules);
    
    $storage = Storage::find($request->id);
    
    $form = $request->all();
    unset($form['_token']);
    
    $storage->fill($form)->save();
    
    // 8/8(土)作成 web.php(routing)で命名したshow_storageからページを取得する redirectする時にパラメータを渡す方法
    return redirect(route('show_storage', ['id' => $request->id]));
  }
}
