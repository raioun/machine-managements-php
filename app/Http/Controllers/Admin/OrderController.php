<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use App\Orderer;
use App\Project;
use App\Customer;
use App\RentalMachine;
use App\Machine;
use App\Branch;
use App\Storage;
use App\Company;

class OrderController extends Controller
{
  public function add(Request $request)
  {
    $users = User::all();
    $orderers = Orderer::all();
    $projects = Project::all();
    $customers = Customer::all();
    $rental_machines = RentalMachine::all();
    $machines = Machine::all();
    $branches = Branch::all();
    $storages = Storage::all();
    $companies = Company::all();
    
    //最後の'rental_machine_id' => $request->id はrental_machine_id毎のorder.createのview画面への移行に対応するため ↑のadd(Request $request)もそのため
    return view('admin.order.create', ['users' => $users, 'orderers' => $orderers, 'projects' => $projects, 'customers' => $customers, 'rental_machines' => $rental_machines, 'machines' => $machines, 'branches' => $branches, 'storages' => $storages, 'companies' => $companies, 'rental_machine_id' => $request->id]);
  }
  
  public function create(Request $request)
  {
    $this->validate($request, Order::$rules);
    
    // 8/5(土)追加 model参照 入庫日が出庫日より未来か？modelで記載したものを呼び出している
    $this->validate($request, Order::after_or_equal($request->out_date));
    
    // 8/5(土)追加 model参照 過去の案件と期間が重複していないかのチェックをmodelから呼び出している エラーメッセージが分かりにくい
    if ($msg = Order::checkDateDuplication($request)){
      return redirect()->back()->withErrors(['in_date' => $msg])->withInput();
    }
    
    $order = new Order;
    $form = $request->all();
    
    unset($form['_token']);
    
    $order->fill($form);
    $order->save();
    
    return redirect('/');
    //登録成否メッセージを入れる
  }
  
  // 
  public function index(Request $request)
  {
    // 消しても問題はない。ここに入力するだけでも、machineの編集は働く
    // $a = \App\Machine::find(4);
    // $a->name='ドリリングバケット';
    // $a->save();
    
    // out_date
    $where = '';
    $i = 0;
    if (isset($request->out_date)) {
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
    
    // user_id / user_nameはindexの<input type="text" name="user_name"/>から飛んでくるデータ
    if (isset($request->user_name)) {
      $users = User::where('name', 'LIKE', "%$request->user_name%")->get();
      // dd($users);
      $query = '(';
      foreach($users as $user) {
        // 三項演算子  　条件式 ? 式1 : 式2 ;
        $query .= $query == '(' ? '' : 'or ';
        // 置換文字 %s　後に記載されている引数(今回の場合は$user->id)を%sに代入する。
        $query .= sprintf("user_id = %s ", $user->id);
      }
      $query .= ')';
      // dd($query);
      if ($i) {
         $where .= ' and ';
      }
      $where .= $query;
      $i++;
    }
    
    // project->customer_id
    if (isset($request->customer_name)) {
      $customers = Customer::where('name', 'LIKE', "%$request->customer_name%")->get();
      $projects = [];
      foreach($customers as $customer) {
        $tmp = Project::where('customer_id', $customer->id)->get()->all();
        $projects = array_merge($projects, $tmp);
      }
      $query = '(';
      foreach($projects as $project) {
        $query .= $query == '(' ? '' : 'or ';
        $query .= sprintf("project_id = %s ", $project->id);
      }
      $query .= ')';
      if ($i) {
         $where .= ' and ';
      }
      $where .= $query;
      $i++;
    }
    
    // project_id
    if (isset($request->project_name)) {
      $projects = Project::where('name', 'LIKE', "%$request->project_name%")->get();
      
      $query = '(';
      foreach($projects as $project) {
        $query .= $query == '(' ? '' : 'or ';
        $query .= sprintf("project_id = %s ", $project->id);
      }
      $query .= ')';
      
      if ($i) {
        $where .= ' and';
      }
      $where .= $query;
      $i++;
    }
    
    // rental_machine->machine_id(name)
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
        $query .= sprintf("rental_machine_id = %s ", $rental_machine->id);
      }
      $query .= ')';
      // dd($query);
      if ($i) {
         $where .= ' and ';
      }
      $where .= $query;
      $i++;
    }
    
    // rental_machine->machine_id(type1)
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
        $query .= sprintf("rental_machine_id = %s ", $rental_machine->id);
      }
      $query .= ')';
      if ($i) {
         $where .= ' and ';
      }
      $where .= $query;
      $i++;
    }
    
    // rental_machine->machine_id(type2)
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
        $query .= sprintf("rental_machine_id = %s ", $rental_machine->id);
      }
      $query .= ')';
      if ($i) {
         $where .= ' and ';
      }
      $where .= $query;
      $i++;
    }
    
    // rental_machine->branch->company_id 
    if (isset($request->company_name)) {
      $companies = Company::where('name', 'LIKE', "%$request->company_name%")->get();
      // dd($companies);
      $branches = [];
      foreach($companies as $company) {
        $tmp = Branch::where('company_id', $company->id)->get()->all();
        // dd($tmp);
        $branches = array_merge($branches, $tmp);
      }
      
      $rental_machines = [];
      foreach($branches as $branch) {
        $tmp = RentalMachine::where('branch_id', $branch->id)->get()->all();
        // dd($tmp);
        $rental_machines = array_merge($rental_machines, $tmp);
      }
      
      $query = '(';
      foreach($rental_machines as $rental_machine) {
        // 三項演算子  　条件式 ? 式1 : 式2 ;
        $query .= $query == '(' ? '' : 'or ';
        // 置換文字 %s　後に記載されている引数(今回の場合は$machine->id)を%sに代入する。
        $query .= sprintf("rental_machine_id = %s ", $rental_machine->id);
      }
      $query .= ')';
      // dd($query);
      if ($i) {
         $where .= ' and ';
      }
      $where .= $query;
      $i++;
    }
    
    // rental_machine->branch_id
    if (isset($request->branch_name)) {
      $branches = Branch::where('name', 'LIKE', "%$request->branch_name%")->get();
      $rental_machines = [];
      foreach($branches as $branch) {
        $tmp = RentalMachine::where('branch_id', $branch->id)->get()->all();
        $rental_machines = array_merge($rental_machines, $tmp);
      }
      $query = '(';
      foreach($rental_machines as $rental_machine) {
        $query .= $query == '(' ? '' : 'or ';
        $query .= sprintf("rental_machine_id = %s ", $rental_machine->id);
      }
      $query .= ')';
      if ($i) {
         $where .= ' and ';
      }
      $where .= $query;
      $i++;
    }
    
    // 最終
    if ($i) {
      $orders = Order::whereRaw($where)->get();
      // dd($where);
    } else {
      $orders = Order::all();
    }
    
    return view('admin.order.index', ['orders' => $orders]);
  }
  
  public function reservation(Request $request)
  {
    $where = '';
    $i = 0;
    if (isset($request->out_date)) {
      $query = sprintf("CAST(out_date as CHAR) LIKE '%%%s%%' ", $request->out_date);
      $where .= $query;
      $i++;
    }
    
    if (isset($request->in_date)) {
      if ($i) {
         $where .= ' and ';
      }
      $query = sprintf("CAST(in_date as CHAR) LIKE '%%%s%%' ", $request->in_date);
      $where .= $query;
      $i++;
    }
    
    if ($i) {
      $reservations = Order::where( 'status', '0')->whereRaw($where)->get();
    } else {
      $reservations = Order::where( 'status', '0')->get();
    }
 
    return view('admin.order.reservation', ['reservations' => $reservations]);
  }
  
  public function use(Request $request)
  {
    $where = '';
    $i = 0;
    if (isset($request->out_date)) {
      $query = sprintf("CAST(out_date as CHAR) LIKE '%%%s%%' ", $request->out_date);
      $where .= $query;
      $i++;
    }
    
    if (isset($request->in_date)) {
      if ($i) {
         $where .= ' and ';
      }
      $query = sprintf("CAST(in_date as CHAR) LIKE '%%%s%%' ", $request->in_date);
      $where .= $query;
      $i++;
    }
    
    if ($i) {
      $uses = Order::where('status', '1')->whereRaw($where)->get();
    } else {
      $uses = Order::where('status', '1')->get();
    }

    return view('admin.order.use', ['uses' => $uses]);
  }
  
  public function cominghome(Request $request)
  {
    $where = '';
    $i = 0;
    if (isset($request->out_date)) {
      $query = sprintf("CAST(out_date as CHAR) LIKE '%%%s%%' ", $request->out_date);
      $where .= $query;
      $i++;
    }
    
    if (isset($request->in_date)) {
      if ($i) {
         $where .= ' and ';
      }
      $query = sprintf("CAST(in_date as CHAR) LIKE '%%%s%%' ", $request->in_date);
      $where .= $query;
      $i++;
    }
    
    if ($i) {
      $cominghomes = Order::where('status', '2')->whereRaw($where)->get();
    } else {
      $cominghomes = Order::where('status', '2')->get();
    }
 
    return view('admin.order.cominghome', ['cominghomes' => $cominghomes]);
  }
  
  public function show(Request $request)
  {
    $order = Order::find($request->id);
    return view('admin.order.show', ['order' => $order]);
  }
  
  public function edit(Request $request)
  {
    $users = User::all();
    $orderers = Orderer::all();
    $projects = Project::all();
    $customers = Customer::all();
    $rental_machines = RentalMachine::all();
    $machines = Machine::all();
    $branches = Branch::all();
    $storages = Storage::all();
    $companies = Company::all();
    
    $order = Order::find($request->id);
    if (empty($order)) {
      abort(404);
    }
    return view('admin.order.edit', ['order' => $order, 'users' => $users, 'orderers' => $orderers, 'projects' => $projects, 'customers' => $customers, 'rental_machines' => $rental_machines, 'machines' => $machines, 'branches' => $branches, 'storages' => $storages, 'companies' => $companies]);
  }
  
  public function update(Request $request)
  {
    $this->validate($request, Order::$rules);
    
    // 8/5(土)追加 model参照 入庫日が出庫日より未来か？modelで記載したものを呼び出している
    $this->validate($request, Order::after_or_equal($request->out_date));
    
    // 8/5(土)追加 model参照 過去の案件と期間が重複していないかのチェックをmodelから呼び出している エラーメッセージが分かりにくい
    // if (!) は、本来、もしtrueならとなるところを反転させ、もしfalseならとするために用いている。
    if ($msg = Order::checkDateDuplication($request)){
      return redirect()->back()->withErrors(['in_date' => $msg])->withInput();
    }
    
    $order = Order::find($request->id);
  
    $form = $request->all();
    unset($form['_token']);
    
    $order->fill($form)->save();
    
    // 8/8(土)作成 web.php(routing)で命名したshow_orderからページを取得する redirectする時にパラメータを渡す方法
    return redirect(route('show_order', ['id' => $request->id]));
  }
  
  public function delete(Request $request)
  {
    $order = Order::find($request->id);
    
    $order->delete();
    return redirect('admin/orders');
  }
}