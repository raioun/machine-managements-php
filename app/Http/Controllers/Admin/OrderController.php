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
    $users = User::all();
    
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
    
    // user_name検索調整中
    if (isset($request->user->name)) {
      if ($i) {
         $where .= ' and ';
      }
      $query = sprintf("name LIKE '%%%s%%' ", $request->user->name);
      $where .= $query;
      $i++;
    }
    
    if ($i) {
      $orders = Order::whereRaw($where)->get();
    } else {
      $orders = Order::all();
    }
    
    return view('admin.order.index', ['orders' => $orders, 'users' => $users]);
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