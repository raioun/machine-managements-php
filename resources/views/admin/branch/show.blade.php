@extends('layouts.admin')

@section('title', '所有営業所詳細')
@section('content')

<h1>所有営業所ID：{{ $branch->id }} の詳細ページ</h1>
<div>
  <p>所有企業名：<a href="/admin/companies/show?id={{ $branch->company->id }}">{{ $branch->company->name }}</a></p>
</div>
<div>
  <p>所有営業所名：{{ $branch->name }}</p>
</div>
<div>
  <p>住所：{{ $branch->address }}</p>
</div>
<div>
  <a class="btn btn-warning" href="/admin/branches/edit?id={{ $branch->id }}">編集</a>
</div>
<div class ="text-center">
  <p><a href="/admin/branches">営業所一覧へ戻る</a></p>
</div>
<div class="text-center">
  <h1>この営業所の機材一覧</h1>
</div>
<div class="text-center">
  <h2>検索フォーム</h2>
</div>

<div class="text-center">
  <form action="{{ action('Admin\BranchController@show') }}" accept-charset="UTF-8" method="get">
  
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
      <label for="code_機番">機番</label>
      <input type="text" name="code" value="@if(isset($inputs['code'])){{ $inputs['code'] }}@endif"/>
    </div>
    
    <div class="form-group">  
      <label for="status_状態">状態</label>
      <select name="status">
        <option value="">指定なし</option>
        <option value="0" @if(isset($inputs['status']) && $inputs['status'] == 0) selected="selected" @endif>良品</option>
        <option value="1" @if(isset($inputs['status']) && $inputs['status'] == 1) selected="selected" @endif>重整備</option>
        <option value="2" @if(isset($inputs['status']) && $inputs['status'] == 2) selected="selected" @endif>廃棄済み</option>
      </select>
    </div>
    <input type="hidden" name="id" value="{{ $branch->id }}" >
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