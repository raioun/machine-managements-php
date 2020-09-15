@extends('layouts.admin')

@section('title', '現場詳細')
@section('content')

<h1>現場ID：{{ $project->id }} の詳細ページ</h1>
<div>
  <p>顧客企業名：<a href="/admin/customers/show?id={{ $project->customer->id }}">{{ $project->customer->name }}</a></p>
</div>
<div>
  <p>現場名：{{ $project->name }}</p>
</div>
<div>
  <p>住所：{{ $project->address }}</p>
</div>
<div>
  <p>状態：{{ $project->status_name() }}</p>
</div>
<div>
  <a class="btn btn-warning" href="/admin/projects/edit?id={{ $project->id }}">編集</a>
</div>
<div class ="text-center">
  <p><a href="/admin/projects">現場一覧へ戻る</a></p>
</div>
<div class="text-center">
  <h1>この現場の案件一覧</h1>
</div>
<div class="text-center">
  <h2>検索フォーム</h2>
</div>


<div class="text-center">
  <form action="{{ action('Admin\ProjectController@show') }}" accept-charset="UTF-8" method="get">
  
    <div class="form-group">
      <label for="status_状態">状態</label>
      <select name="status">
        <option value="">指定なし</option>
        <option value="0" @if(isset($inputs['status']) && $inputs['status'] == 0) selected="selected" @endif>予約中</option>
        <option value="1" @if(isset($inputs['status']) && $inputs['status'] == 1) selected="selected" @endif>出庫中</option>
        <option value="2" @if(isset($inputs['status']) && $inputs['status'] == 2) selected="selected" @endif>返却済み</option>
      </select>
    </div>
    
    <div class="form-group">
      <label for="out_date_出庫日">出庫日</label>
      <input type="text" name="out_date" value="@if(isset($inputs['out_date'])){{ $inputs['out_date'] }}@endif"/>
    </div>
    
    <div class="form-group">
      <label for="in_date_返却日">返却日</label>
      <input type="text" name="in_date" value="@if(isset($inputs['in_date'])){{ $inputs['in_date'] }}@endif"/>
    </div>
    <input type="hidden" name="id" value="{{ $project->id }}" >
    <div><input type="submit" value="検索" data-disable-with="検索" /></div>
  </form>
</div>

<ul class="media-list">
  @foreach($orders as $order)  
    <li class="media">
      <div>
        <p>案件ID：{{ $order->id }}/状態：{{ $order->status_name() }}</p>
      </div>
      <div>
        <p>出庫日時：{{ $order->out_date }}/入庫日時：{{ $order->in_date }}/</p>
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