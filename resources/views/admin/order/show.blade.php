@extends('layouts.admin')

@section('title', '案件詳細')
@section('content')
      
<h1>案件ID：{{ $order->id }}の詳細ページ</h1>
<div>
  <p>状態：{{ $order->status_name() }}</p>
</div>
<div>
  <p>出庫日時：{{ $order->out_date }} / {{ $order->out_time }}</p>
</div>
<div>
  <p>入庫日時：{{ $order->in_date }} / {{ $order->in_time }}</p>
</div>
<div>
  <p>応対者：<a href="/admin/users/show?id={{ $order->user->id }}">{{ $order->user->name }}</a></p>
</div>
<div>
  <p>顧客名：<a href="/admin/customers/show?id={{ $order->project->customer->id }}">{{ $order->project->customer->name }}</a></p>
</div>
<div>
  <p>現場名：<a href="/admin/projects/show?id={{ $order->project->id }}">{{ $order->project->name }}</a></p>
</div>
<div>
  <p>発注者名：<a href="/admin/orderers/show?id={{ $order->orderer->id }}">{{ $order->orderer->family_name }} / {{ $order->orderer->first_name }}</a></p>
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
  <p>予約日時：{{ $order->created_at }}</p>
</div>
<div>
  <p>変更日時：{{ $order->updated_at }}</p>
</div>
<div class="button-space">
  <a class="btn btn-warning" href="/admin/orders/edit?id={{ $order->id }} ">編集</a>
</div>
<div class="button-space">
    <a data-confirm="本当に削除してよろしいですか？" class="btn btn-danger" rel="nofollow" data-method="delete" href="{{ action('Admin\OrderController@delete', ['id' => $order->id]) }}">案件削除</a>
</div>
<div class ="text-center">
  <p><a href="/admin/orders">案件一覧へ戻る</a></p>
</div>

@endsection