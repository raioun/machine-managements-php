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