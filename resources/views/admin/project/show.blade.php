@extends('layouts.admin')

@section('title', '現場詳細')
@section('content')

<h1>現場ID：{{ $project->id }} の詳細ページ</h1>
<div>
  <p>顧客企業名：<a href="/admin/customers/show?id={{ $project->customer->id }}">{{ $project->customer->name }}</a></p>
</div>
<div>
  <p>現場名：{{ $project->name }}</p>
</div>
<div>
  <p>住所：{{ $project->address }}</p>
</div>
<div>
  <p>状態：{{ $project->status_name() }}</p>
</div>
<div>
  <a class="btn btn-warning" href="/admin/projects/edit?id={{ $project->id }}">編集</a>
</div>
<div class ="text-center">
  <p><a href="/admin/projects">現場一覧へ戻る</a></p>
</div>
<div class="text-center">
  <h1>この現場の案件一覧</h1>
</div>
<div class="text-center">
  <h2>検索フォーム</h2>
</div>


<div class="text-center">
  <form action="/projects/3" accept-charset="UTF-8" method="get"><input name="utf8" type="hidden" value="&#x2713;" />
  
    <div class="form-group">
      <label for="status_状態">状態</label>
      <select name="order[status]" id="order_status">
        <option value="0">予約中</option>
        <option value="1">出庫中</option>
        <option value="2">返却済み</option>
      </select>
    </div>
    
    <div class="form-group">
      <label for="out_date_出庫日">出庫日</label>
      <input type="text" name="out_date" id="out_date" />
    </div>
    
    <div class="form-group">
      <label for="in_date_返却日">返却日</label>
      <input type="text" name="in_date" id="in_date" />
    </div>
    
    <div><input type="submit" value="検索" data-disable-with="検索" /></div>
  </form>
</div>

<ul class="media-list">
    <li class="media">
      <div>
        <p>案件ID：11/状態：返却済み</p>
      </div>
      <div>
        <p>出庫日時：2019-08-01//入庫日時：2019-08-09/</p>
      </div>
      <div>
        <p>応対者：<a href="/users/1">田中太郎</a></p>
      </div>
      <div>
        <p>顧客名：<a href="/customers/2">日興基礎株式会社</a>/現場名：<a href="/projects/3">美浜区真砂1号機</a></p>
      </div>
      <div>
        <p>機材名：<a href="/machines/10">スタンドパイプ</a>/<a href="/machines/10">Φ1800</a>/<a href="/machines/10">6m</a></p>
      </div>
      <div>
        <p>機番：<a href="/rental_machines/6"></a></p>
      </div>
      <div>
        <p>備考欄：耳面一付</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orders/11">詳細</a>
      </div>
    </li>
  
</ul>

@endsection