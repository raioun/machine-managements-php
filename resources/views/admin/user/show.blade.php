@extends('layouts.admin')

@section('title', 'ユーザ詳細')
@section('content')

<h1>ユーザID：{{ $user->id }}の詳細ページ</h1>
<div>
  <p>ユーザ名：{{ $user->name }}</p>
</div>
<div>
  <p>状態：{{ $user->status_name() }}</p>
</div>
<div>
  <a class="btn btn-warning" href="/admin/users/edit?id={{ $user->id }}">編集</a>
</div>

<div class ="text-center">
  <p><a href="/admin/users">ユーザ一覧へ戻る</a></p>
</div>

<div class="text-center">
  <h1>このユーザが応対している案件一覧</h1>
</div>
<div class="text-center">
  <h2>検索フォーム</h2>
</div>


<div class="text-center">
  <form action="{{ action('Admin\UserController@show') }}" accept-charset="UTF-8" method="get">
  
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
    <input type="hidden" name="id" value="{{ $user->id }}" >
    <div><input type="submit" value="検索" data-disable-with="検索" /></div>
  </form>
</div>

  <div class="row">
    <div class="list-orders col-md-10 mx-auto">
      <div class="row">
        <table class="table">
          <thead>
            <tr>
              <th width="5%">案件ID</th>
              <th width="8%">状態</th>
              <th width="10%">出庫日時</th>
              <th width="10%">入庫日時</th>
              <th width="10%">応対者</th>
              <th width="10%">顧客名</th>
              <th width="10%">現場名</th>
              <th width="20%">機材名</th>
              <th width="5%">機番</th>
              <th width="10%">備考欄</th>
              <th width="10%">詳細画面</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orders as $order) 
              <tr>
                <th>{{ $order->id }}</th>
                <th>{{ $order->status_name() }}</th>
                <td>{{ $order->out_date }}</td>
                <td>{{ $order->in_date }}</td>
                <td><a href="/admin/users/show?id={{ $order->user->id }}">{{ $order->user->name }}</a></td>
                <td><a href="/admin/customers/show?id={{ $order->project->customer->id }}">{{ $order->project->customer->name }}</a></td>
                <td><a href="/admin/projects/show?id={{ $order->project->id }}">{{ $order->project->name }}</a></td>
                <td><a href="/admin/machines/show?id={{ $order->rental_machine->machine->id }}">{{ $order->rental_machine->machine->name }} / {{ $order->rental_machine->machine->type1 }} / {{ $order->rental_machine->machine->type2 }}</a></td>
                <td><a href="/admin/rental_machines/show?id={{ $order->rental_machine->id }}">{{ $order->rental_machine->code }}</a></td>
                <td>{{ $order->remarks }}</td>
                <td><a class="btn btn-primary" href="/admin/orders/show?id={{ $order->id }}">詳細</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection