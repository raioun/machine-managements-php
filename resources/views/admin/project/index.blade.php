@extends('layouts.admin')

@section('title', '現場一覧')
@section('content')

<div class="text-center">
  <h1>現場検索フォーム</h1>
</div>

<div class="text-center">
  <form action="{{ action('Admin\ProjectController@index') }}" accept-charset="UTF-8" method="get">
    
    <div class="form-group">
      <label for="customer_顧客企業名">顧客企業名</label>
      <input type="text" name="customer_name" value="@if(isset($inputs['customer_name'])){{ $inputs['customer_name'] }}@endif"/>
    </div>
    
    <div class="form-group">
      <label for="name_現場名">現場名</label>
      <input type="text" name="name" value="@if(isset($inputs['name'])){{ $inputs['name'] }}@endif">
    </div>
    
    <div class="form-group">
      <label for="status_状態">状態</label>
      <select name="status">
        <option value="">指定なし</option>
        <option value="0" @if(isset($inputs['status']) && $inputs['status'] == 0) selected="selected" @endif>施工中</option>
        <option value="1" @if(isset($inputs['status']) && $inputs['status'] == 1) selected="selected" @endif>施工済み</option>
      </select>
    </div>
  
    <div><input type="submit" value="検索" data-disable-with="検索" /></div>
  </form>
</div>


    {{--()がないと、モデルに関連付けられた他のモデルのインスタンスを返す。自身モデルのインスタンスを返す場合。
    ex:orderer内で、そのordererのorders一覧を表示したい場合 $orderer->orders; $ordererテーブルのfamily_nameを使用する場合 $orderer->family_name;
    
    ()があれば、関数を呼んだことになる。DB内の値を返すわけではない。$statusesのように、関数で定義されているのみで、DB外のデータであるもの。
    Ruby_on_Railsではこれらの区別を付けていなくても勝手に処理してくれるが、LaravelPHPではこの区別が必要--}}

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