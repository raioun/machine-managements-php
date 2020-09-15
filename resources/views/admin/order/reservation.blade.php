@extends('layouts.admin')

@section('title', '予約中の案件一覧')
@section('content')

<div class="text-center">
  <h1>案件検索フォーム</h1>
</div>
<div class="text-center">
  <form action="{{ action('Admin\OrderController@reservation') }}" accept-charset="UTF-8" method="get">
  
    <div class="form-group">
      <label for="out_date_出庫日">出庫日</label>
      <input type="text" name="out_date" value="@if(isset($inputs['out_date'])){{ $inputs['out_date'] }}@endif"/>
    </div>
      
    <div class="form-group">
      <label for="in_date_入庫日">入庫日</label>
      <input type="text" name="in_date" value="@if(isset($inputs['in_date'])){{ $inputs['in_date'] }}@endif"/>
    </div>
    
    <div class="form-group">
      <label for="user_ユーザ名">応対ユーザ名</label>
      <input type="text" name="user_name" value="@if(isset($inputs['user_name'])){{ $inputs['user_name'] }}@endif"/>
    </div>
    
    <div class="form-group">
      <label for="customer_顧客企業名">顧客企業名</label>
      <input type="text" name="customer_name" value="@if(isset($inputs['customer_name'])){{ $inputs['customer_name'] }}@endif"/>
    </div>
      
    <div class="form-group">
      <label for="project_現場名">現場名</label>
      <input type="text" name="project_name" value="@if(isset($inputs['project_name'])){{ $inputs['project_name'] }}@endif"/>
    </div>
    
    <div class="form-group">
      <label for="machine_機材名">機材名</label>
      <input type="text" name="machine_name" value="@if(isset($inputs['machine_name'])){{ $inputs['machine_name'] }}@endif"/>
    </div>
      
    <div class="form-group">
      <label for="type1_型式1">型式1</label>
      <input type="text" name="machine_type1" value="@if(isset($inputs['machine_type1'])){{ $inputs['machine_type1'] }}@endif"/>
    </div>
    
    <div class="form-group">
      <label for="type2_型式2">型式2</label>
      <input type="text" name="machine_type2" value="@if(isset($inputs['machine_type2'])){{ $inputs['machine_type2'] }}@endif"/>
    </div>
    
    <div class="form-group">
      <label for="company_所有企業名">所有企業名</label>
      <input type="text" name="company_name" value="@if(isset($inputs['company_name'])){{ $inputs['company_name'] }}@endif"/>
    </div>
    
    <div class="form-group">
      <label for="branch_所有営業所名">所有営業所名</label>
      <input type="text" name="branch_name" value="@if(isset($inputs['branch_name'])){{ $inputs['branch_name'] }}@endif"/>
    </div>
    
    <div><input type="submit" value="検索" data-disable-with="検索" /></div>
  </form>
</div>

<div class="col-xs-6">
  <ul class="nav nav-tabs nav-justified">
    <li class=""><a href="/admin/orders">全ての案件</a></li>
    <li class="active"><a href="/admin/orders/reservations">予約中の案件</a></li>
    <li class=""><a href="/admin/orders/uses">出庫中の案件</a></li>
    <li class=""><a href="/admin/orders/cominghomes">返却済みの案件</a></li>
  </ul>
  
    {{--()がないと、モデルに関連付けられた他のモデルのインスタンスを返す。自身モデルのインスタンスを返す場合。
    ex:orderer内で、そのordererのorders一覧を表示したい場合 $orderer->orders; $ordererテーブルのfamily_nameを使用する場合 $orderer->family_name;
    
    ()があれば、関数を呼んだことになる。DB内の値を返すわけではない。$statusesのように、関数で定義されているのみで、DB外のデータであるもの。
    Ruby_on_Railsではこれらの区別を付けていなくても勝手に処理してくれるが、LaravelPHPではこの区別が必要--}}

<ul class="media-list">
  @foreach($reservations as $reservation)  
    <li class="media">
      <div>
        <p>案件ID：{{ $reservation->id }}/状態：{{ $reservation->status_name() }}</p>
      </div>
      <div>
        <p>出庫日時：{{ $reservation->out_date }}//入庫日時：{{ $reservation->in_date }}/</p>
      </div>
      <div>
        <p>応対者：<a href="/admin/users/show?id={{ $reservation->user->id }}">{{ $reservation->user->name }}</a></p>
      </div>
      <div>
        <p>顧客名：<a href="/admin/customers/show?id={{ $reservation->project->customer->id }}">{{ $reservation->project->customer->name }}</a>/現場名：<a href="/admin/projects/show?id={{ $reservation->project->id }}">{{ $reservation->project->name }}</a></p>
      </div>
      <div>
        <p>機材名：<a href="/admin/machines/show?id={{ $reservation->rental_machine->machine->id }}">{{ $reservation->rental_machine->machine->name }} / {{ $reservation->rental_machine->machine->type1 }} / {{ $reservation->rental_machine->machine->type2 }}</a></p>
      </div>
      <div>
        <p>機番：<a href="/admin/rental_machines/show?id={{ $reservation->rental_machine->id }}">{{ $reservation->rental_machine->code }}</a></p>
      </div>
      <div>
        <p>備考欄：{{ $reservation->remarks }}</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/admin/orders/show?id={{ $reservation->id }}">詳細</a> 
      </div>
    </li>
  @endforeach
</ul>

@endsection