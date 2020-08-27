@extends('layouts.admin')

@section('title', '全ての案件一覧')
@section('content')

<div class="text-center">
  <h1>案件検索フォーム</h1>
</div>
<div class="text-center">
  <form action="{{ action('Admin\OrderController@index') }}" accept-charset="UTF-8" method="get">
  
    <div class="form-group">
      <label for="out_date_出庫日">出庫日</label>
      <input type="text" name="out_date"/>
    </div>
      
    <div class="form-group">
      <label for="in_date_入庫日">入庫日</label>
      <input type="text" name="in_date"/>
    </div>
    
    {{-- 修正中 --}}
    <div class="form-group">
      <label for="user_id">応対ユーザ名</label>
      <input type="text" name="user" id="user" />
    </div>
    
    <div class="form-group">
      <label for="customer_顧客企業名">顧客企業名</label>
      <input type="text" name="customer" id="customer" />
    </div>
      
    <div class="form-group">
      <label for="project_現場名">現場名</label>
      <input type="text" name="project" id="project" />
    </div>
    
    <div class="form-group">
      <label for="machine_機材名">機材名</label>
      <input type="text" name="machine" id="machine" />
    </div>
      
    <div class="form-group">
      <label for="type1_型式1">型式1</label>
      <input type="text" name="type1" id="type1" />
    </div>
    
    <div class="form-group">
      <label for="type2_型式2">型式2</label>
      <input type="text" name="type2" id="type2" />
    </div>
    
    <div class="form-group">
      <label for="company_所有企業名">所有企業名</label>
      <input type="text" name="company" id="company" />
    </div>
    
    <div class="form-group">
      <label for="branch_所有営業所名">所有営業所名</label>
      <input type="text" name="branch" id="branch" />
    </div>
    
    <div><input type="submit" value="検索" data-disable-with="検索" /></div>
  </form>
</div>

<div class="col-xs-6">
  <ul class="nav nav-tabs nav-justified">
    <li class="active"><a href="/admin/orders">全ての案件</a></li>
    <li class=""><a href="/admin/orders/reservations">予約中の案件</a></li>
    <li class=""><a href="/admin/orders/uses">出庫中の案件</a></li>
    <li class=""><a href="/admin/orders/cominghomes">返却済みの案件</a></li>
  </ul>
  
    {{--()がないと、モデルに関連付けられた他のモデルのインスタンスを返す。自身モデルのインスタンスを返す場合。
    ex:orderer内で、そのordererのorders一覧を表示したい場合 $orderer->orders; $ordererテーブルのfamily_nameを使用する場合 $orderer->family_name;
    
    ()があれば、関数を呼んだことになる。DB内の値を返すわけではない。$statusesのように、関数で定義されているのみで、DB外のデータであるもの。
    Ruby_on_Railsではこれらの区別を付けていなくても勝手に処理してくれるが、LaravelPHPではこの区別が必要--}}

<ul class="media-list">
  @foreach($orders as $order)  
    <li class="media">
      <div>
        <p>案件ID：{{ $order->id }}/状態：{{ $order->status_name() }}</p>
      </div>
      <div>
        <p>出庫日時：{{ $order->out_date }}//入庫日時：{{ $order->in_date }}/</p>
      </div>
      <div>
        <p>応対者：<a href="/admin/users/show?id={{ $order->user->id }}">{{ $order->user->name }}</a></p>
      </div>
      <div>
        <p>顧客名：<a href="/admin/customers/show?id={{ $order->project->customer->id }}">{{ $order->project->customer->name }}</a>/現場名：<a href="/admin/projects/show?id={{ $order->project->id }}">{{ $order->project->name }}</a></p>
      </div>
      <div>
        <p>機材名：<a href="/admin/machines/show?id={{ $order->rental_machine->machine->id }}">{{ $order->rental_machine->machine->name }} / {{ $order->rental_machine->machine->type1 }} / {{ $order->rental_machine->machine->type2 }}</a></p>
      </div>
      <div>
        <p>機番：<a href="/admin/rental_machines/show?id={{ $order->rental_machine->id }}">{{ $order->rental_machine->code }}</a></p>
      </div>
      <div>
        <p>備考欄：{{ $order->remarks }}</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/admin/orders/show?id={{ $order->id }}">詳細</a>
      </div>
    </li>
  @endforeach
</ul>

@endsection