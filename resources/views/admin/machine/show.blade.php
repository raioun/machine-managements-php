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

  <div class="row">
    <div class="list-orders col-md-10 mx-auto">
      <div class="row">
        <table class="table">
          <thead>
            <tr>
              <th width="20%">機材名</th>
              <th width="5%">機番</th>
              <th width="15%">所有営業所名</th>
              <th width="15%">保管場所</th>
              <th width="10%">状態</th>
              <th width="10%">備考欄</th>
              <th width="10%">詳細画面</th>
              <th width="10%">予約画面</th>
            </tr>
          </thead>
          <tbody>
            @foreach($rental_machines as $rental_machine) 
              <tr>
                <th><a href="/admin/machines/show?id={{ $rental_machine->machine->id }}">{{ $rental_machine->machine->name }} / {{ $rental_machine->machine->type1 }} / {{ $rental_machine->machine->type2 }} / {{ $rental_machine->machine->code }}</a></th>
                <th>{{ $rental_machine->code }}</th>
                <td><a href="/admin/branches/show?id={{ $rental_machine->branch->id }}">{{ $rental_machine->branch->company->name }} / {{ $rental_machine->branch->name }}</a></td>
                <td><a href="/admin/storages/show?id={{ $rental_machine->storage->id }}">{{ $rental_machine->storage->company->name }} / {{ $rental_machine->storage->name }}</a></td>
                <td>{{ $rental_machine->status_name() }}</td>
                <td>{{ $rental_machine->remarks }}</td>
                <td><a class="btn btn-primary" href="/admin/rental_machines/show?id={{ $rental_machine->id }}">詳細</a></td>
                <td><a class="btn btn-success" href="/admin/orders/create?id={{ $rental_machine->id }}">貸し出す</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection