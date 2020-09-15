@extends('layouts.admin')

@section('title', '顧客企業詳細')
@section('content')
 
<h1>顧客企業ID：{{$customer->id}} の詳細ページ</h1>
<div>
  <p>顧客企業名：{{$customer->name}} </p>
</div>
<div>
  <a class="btn btn-warning" href="/admin/customers/edit?id={{ $customer->id }}">編集</a>
</div>
<div class ="text-center">
  <p><a href="/admin/customers">顧客企業一覧へ戻る</a></p>
</div>

<div class="text-center">
  <h1>この顧客企業の発注者一覧</h1>
</div>
<div class="text-center">
  <h2>検索フォーム</h2>
</div>

<div class="text-center">
  <form action="{{ action('Admin\CustomerController@show') }}" accept-charset="UTF-8" method="get">
  
    <div class="form-group">
      <label for="status_状態">状態</label>
      <select name="orderer_status">
        <option value="">指定なし</option>
        <option value="0" @if(isset($inputs['orderer_status']) && $inputs['orderer_status'] == 0) selected="selected" @endif>在籍中</option>
        <option value="1" @if(isset($inputs['orderer_status']) && $inputs['orderer_status'] == 1) selected="selected" @endif>退社済み</option>
      </select>
    </div>

    <div class="form-group">
      <label for="family_name_発注者名(苗字のみ)">発注者名(苗字のみ)</label>
      <input type="text" name="family_name" value="@if(isset($inputs['family_name'])){{ $inputs['family_name'] }}@endif"/>
    </div>
    
    <input type="hidden" name="id" value="{{ $customer->id }}" >
    <div><input type="submit" value="検索" data-disable-with="検索" /></div>
  </form>
</div>

<ul class="media-list">
  @foreach($orderers as $orderer)  
    <li class="media">
      <div>
        <p>顧客企業名：<a href="/admin/customers/show?id={{ $orderer->customer->id }}">{{ $orderer->customer->name }}</a></p>
      </div>
      <div>
        <p>発注者名：{{ $orderer->family_name }}</p>
      </div>
      <div>
        <p>状態：{{ $orderer->status_name() }}</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/admin/orderers/show?id={{ $orderer->id }}">詳細</a>
      </div>
    </li>
  @endforeach
</ul>

<div class="text-center">
  <h1>この顧客企業の現場一覧</h1>
</div>
<div class="text-center">
  <h2>検索フォーム</h2>
</div>

<div class="text-center">
  <form action="{{ action('Admin\CustomerController@show') }}" accept-charset="UTF-8" method="get">
  
    <div class="form-group">
      <label for="status_状態">状態</label>
      <select name="project_status">
        <option value="">指定なし</option>
        <option value="0" @if(isset($inputs['project_status']) && $inputs['project_status'] == 0) selected="selected" @endif>施工中</option>
        <option value="1" @if(isset($inputs['project_status']) && $inputs['project_status'] == 1) selected="selected" @endif>施工済み</option>
      </select>
    </div>
    
    <div class="form-group">
      <label for="project_現場名">現場名</label>
      <input type="text" name="project_name" value="@if(isset($inputs['project_name'])){{ $inputs['project_name'] }}@endif"/>
    </div>
    <input type="hidden" name="id" value="{{ $customer->id }}" >
    <div><input type="submit" value="検索" data-disable-with="検索" /></div>
  </form>
</div>

<ul class="media-list">
  @foreach($projects as $project)  
    <li class="media">
      <div>
        <p>顧客企業名：<a href="/admin/customers/show?id={{ $project->customer->id }}">{{ $project->customer->name }}</a></p>
      </div>
      <div>
        <p>現場名：{{ $project->name }}</p>
      </div>
      <div>
        <p>状態：{{ $project->status_name() }}</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/admin/projects/show?id={{ $project->id }}">詳細</a>
      </div>
    </li>
  @endforeach
</ul>

@endsection