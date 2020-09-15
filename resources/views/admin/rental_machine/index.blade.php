@extends('layouts.admin')

@section('title', 'レンタル機材一覧')
@section('content')
      
<div class="text-center">
  <h1>レンタル機材検索フォーム</h1>
</div>


<div class="text-center">
  <form action="{{ action('Admin\RentalMachineController@index') }}" accept-charset="UTF-8" method="get">
  
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
      <input type="text" name="code" value="@if(isset($inputs['code'])){{ $inputs['code'] }}@endif">
    </div>

    <div class="form-group">
      <label for="company_所有企業名">所有企業名</label>
      <input type="text" name="branch_company_name" value="@if(isset($inputs['branch_company_name'])){{ $inputs['branch_company_name'] }}@endif"/>
    </div>
    
    <div class="form-group">
      <label for="branch_所有営業所名">所有営業所名</label>
      <input type="text" name="branch_name" value="@if(isset($inputs['branch_name'])){{ $inputs['branch_name'] }}@endif"/>
    </div>
    
    <div class="form-group">
      <label for="storage_company_保管企業名">保管企業名</label>
      <input type="text" name="storage_company_name" value="@if(isset($inputs['storage_company_name'])){{ $inputs['storage_company_name'] }}@endif"/>
    </div>
    
    <div class="form-group">
      <label for="storage_保管場所名">保管場所名</label>
      <input type="text" name="storage_name" value="@if(isset($inputs['storage_name'])){{ $inputs['storage_name'] }}@endif"/>
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