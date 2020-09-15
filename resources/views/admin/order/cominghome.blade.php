@extends('layouts.admin')

@section('title', '返却済みの案件一覧')
@section('content')
      
<div class="text-center">
  <h1>案件検索フォーム</h1>
</div>
<div class="text-center">
  <form action="{{ action('Admin\OrderController@cominghome') }}" accept-charset="UTF-8" method="get">
    
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
    <li class=""><a href="/admin/orders/reservations">予約中の案件</a></li>
    <li class=""><a href="/admin/orders/uses">出庫中の案件</a></li>
    <li class="active"><a href="/admin/orders/cominghomes">返却済みの案件</a></li>
  </ul>
  
<ul class="media-list">
  @foreach($cominghomes as $cominghome)  
    <li class="media">
      <div>
        <p>案件ID：{{ $cominghome->id }}/状態：{{ $cominghome->status_name() }}</p>
      </div>
      <div>
        <p>出庫日時：{{ $cominghome->out_date }}//入庫日時：{{ $cominghome->in_date }}/</p>
      </div>
      <div>
        <p>応対者：<a href="/admin/users/show?id={{ $cominghome->user->id }}">{{ $cominghome->user->name }}</a></p>
      </div>
      <div>
        <p>顧客名：<a href="/admin/customers/show?id={{ $cominghome->project->customer->id }}">{{ $cominghome->project->customer->name }}</a>/現場名：<a href="/admin/projects/show?id={{ $cominghome->project->id }}">{{ $cominghome->project->name }}</a></p>
      </div>
      <div>
        <p>機材名：<a href="/admin/machines/show?id={{ $cominghome->rental_machine->machine->id }}">{{ $cominghome->rental_machine->machine->name }} / {{ $cominghome->rental_machine->machine->type1 }} / {{ $cominghome->rental_machine->machine->type2 }}</a></p>
      </div>
      <div>
        <p>機番：<a href="/admin/rental_machines/show?id={{ $cominghome->rental_machine->id }}">{{ $cominghome->rental_machine->code }}</a></p>
      </div>
      <div>
        <p>備考欄：{{ $cominghome->remarks }}</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/admin/orders/show?id={{ $cominghome->id }}">詳細</a>
      </div>
    </li>
  @endforeach
</ul>

@endsection