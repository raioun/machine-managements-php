@extends('layouts.admin')

@section('title', 'レンタル機材詳細')
@section('content')

<h1>機材ID：{{ $rental_machine->id }}の詳細ページ</h1>
<div>
  <p>機材名：<a href="/admin/machines/show?id={{ $rental_machine->machine->id }}">{{ $rental_machine->machine->name }}</a></p>
</div>
<div>
  <p>型式1：<a href="/admin/machines/show?id={{ $rental_machine->machine->id }}">{{ $rental_machine->machine->type1 }}</a></p>
</div>
<div>
  <p>型式2：<a href="/admin/machines/show?id={{ $rental_machine->machine->id }}">{{ $rental_machine->machine->type2 }}</a></p>
</div>
<div>
  <p>機番：{{ $rental_machine->code }}</p>
</div>
<div>
  <p>所有企業名：<a href="/admin/companies/show?id={{ $rental_machine->branch->company->id }}">{{ $rental_machine->branch->company->name }}</a></p>
</div>
<div>
  <p>所有営業所名：<a href="/admin/branches/show?id={{ $rental_machine->branch->id }}">{{ $rental_machine->branch->name }}</a></p>
</div>
<div>
  <p>所有営業所住所：{{ $rental_machine->branch->address }}</p>
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
  <a class="btn btn-warning" href="/admin/rental_machines/edit?id={{ $rental_machine->id }} ">編集</a>
</div>
<div class="button-space">
    <a class="btn btn-success" href="/admin/orders/create?id={{ $rental_machine->id }}">貸し出す</a>
</div>
<div class ="text-center">
  <p><a href="/admin/rental_machines">機材一覧へ戻る</a></p>
</div>
<div class="text-center">
  <h1>この機材の案件一覧</h1>
</div>
<div class="text-center">
  <h2>検索フォーム</h2>
</div>


<div class="text-center">
  <form action="/rental_machines/3" accept-charset="UTF-8" method="get"><input name="utf8" type="hidden" value="&#x2713;" />
  
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
        <p>案件ID：12/状態：予約中</p>
      </div>
      <div>
        <p>出庫日時：2019-08-13//入庫日時：2019-10-13/</p>
      </div>
      <div>
        <p>応対者：<a href="/users/1">田中太郎</a></p>
      </div>
      <div>
        <p>顧客名：<a href="/customers/2">日興基礎株式会社</a>/現場名：<a href="/projects/1">大田区南六郷</a></p>
      </div>
      <div>
        <p>機材名：<a href="/machines/2">Wケーシング</a>/<a href="/machines/2">φ1000</a>/<a href="/machines/2">1cc</a></p>
      </div>
      <div>
        <p>機番：<a href="/rental_machines/3">103</a></p>
      </div>
      <div>
        <p>備考欄：</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orders/12">詳細</a>
      </div>
    </li>
    <li class="media">
      <div>
        <p>案件ID：20/状態：予約中</p>
      </div>
      <div>
        <p>出庫日時：2021-10-06//入庫日時：2021-10-06/</p>
      </div>
      <div>
        <p>応対者：<a href="/users/1">田中太郎</a></p>
      </div>
      <div>
        <p>顧客名：<a href="/customers/2">日興基礎株式会社</a>/現場名：<a href="/projects/4">清水口</a></p>
      </div>
      <div>
        <p>機材名：<a href="/machines/2">Wケーシング</a>/<a href="/machines/2">φ1000</a>/<a href="/machines/2">1cc</a></p>
      </div>
      <div>
        <p>機番：<a href="/rental_machines/3">103</a></p>
      </div>
      <div>
        <p>備考欄：</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orders/20">詳細</a>
      </div>
    </li>
  
</ul>

@endsection