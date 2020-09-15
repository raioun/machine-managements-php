@extends('layouts.admin')

@section('title', '機材名詳細')
@section('content')

<h1>機材ID：{{ $machine->id }}の詳細ページ</h1>
<div>
  <p>機材名：{{ $machine->name }}</p>
</div>
<div>
  <p>型式1：{{ $machine->type1 }}</p>
</div>
<div>
  <p>型式2：{{ $machine->type2 }}</p>
</div>
<div class ="text-center">
  <p><a href="/admin/machines">現場一覧へ戻る</a></p>
</div>
<div class="text-center">
  <h1>この機材名・型式の機材一覧</h1>
</div>
<div class="text-center">
  <h2>検索フォーム</h2>
</div>

<div class="text-center">
  <form action="{{ action('Admin\MachineController@show') }}" accept-charset="UTF-8" method="get">
  
    <div class="form-group">
      <label for="status_状態">状態</label>
      <select name="status">
        <option value="">指定なし</option>
        <option value="0" @if(isset($inputs['status']) && $inputs['status'] == 0) selected="selected" @endif>良品</option>
        <option value="1" @if(isset($inputs['status']) && $inputs['status'] == 1) selected="selected" @endif>重整備</option>
        <option value="2" @if(isset($inputs['status']) && $inputs['status'] == 2) selected="selected" @endif>廃棄済み</option>
      </select>
    </div>
    
    <div class="form-group">
      <label for="code_機番">機番</label>
      <input type="text" name="code" value="@if(isset($inputs['code'])){{ $inputs['code'] }}@endif"/>
    </div>

    <input type="hidden" name="id" value="{{ $machine->id }}" >
    <div><input type="submit" value="検索" data-disable-with="検索" /></div>
  </form>
</div>

<ul class="media-list">
  @foreach($rental_machines as $rental_machine)  
    <li class="media">
      <div>
        <p>機材名：<a href="/admin/machines/show?id={{ $rental_machine->machine->id }}">{{ $rental_machine->machine->name }} / {{ $rental_machine->machine->type1 }} / {{ $rental_machine->machine->type2 }} / {{ $rental_machine->machine->code }}</a></p>
      </div>
      <div>
        <p>機番：{{ $rental_machine->code }}</p>
      </div>
      <div>
        <p>所有営業所名：<a href="/admin/branches/show?id={{ $rental_machine->branch->id }}">{{ $rental_machine->branch->company->name }} / {{ $rental_machine->branch->name }}</a></p>
      </div>
      <div>
        <p>保管場所：<a href="/admin/storages/show?id={{ $rental_machine->storage->id }}">{{ $rental_machine->storage->company->name }} / {{ $rental_machine->storage->name }}</a></p>
      </div>
      <div>
        <p>状態：{{ $rental_machine->status_name() }}</p>
      </div>
      <div>
        <p>備考欄：{{ $rental_machine->remarks }}</p>
      </div>
      <div class="button-space">
        <a class="btn btn-primary" href="/admin/rental_machines/show?id={{ $rental_machine->id }}">詳細</a>
      </div>
      <div class="button-space">
          @if($rental_machine->status == 2)
            <p> 廃棄済みのため、出庫できません。</p>
          @else
            <a class="btn btn-success" href="/admin/orders/create?id={{ $rental_machine->id }}">貸し出す</a>
          @endif
      </div>
    </li>
  @endforeach
</ul>

@endsection