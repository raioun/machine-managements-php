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
  <form action="/machines/9" accept-charset="UTF-8" method="get"><input name="utf8" type="hidden" value="&#x2713;" />
  
    <div class="form-group">
      <label for="code_機番">機番</label>
      <input type="text" name="code" id="code" />
    </div>
      
    <div class="form-group">
      <label for="status_状態">状態</label>
      <select name="rental_machine[status]" id="rental_machine_status">
        <option value="0">良品</option>
        <option value="1">重整備</option>
        <option value="2">廃棄済み</option>
      </select>
    </div>
    
    <div><input type="submit" value="検索" data-disable-with="検索" /></div>
  </form>
</div>
  <ul class="media-list">

  
    <li class="media">
      <div>
        <p>機材名：<a href="/machines/9">スタンドパイプ</a>/<a href="/machines/9">Φ2000</a>/<a href="/machines/9">6m</a></p>
      </div>
      <div>
        <p>機番：</p>
      </div>
      <div>
        <p>在庫状況：
            予約中
        </p>
      </div>
      <div>
        <p>所有営業所名：<a href="/companies/1">株式会社中建サービス</a><a href="/branches/1">東京営業所</a></p>
      </div>
      <div>
        <p>保管場所：株式会社中建サービス東京営業所</p>
      </div>
      <div>
        <p>状態：良品</p>
      </div>
      <div>
        <p>備考欄：耳面一付き</p>
      </div>
      <div class="button-space">
        <a class="btn btn-primary" href="/rental_machines/4">詳細</a>
      </div>
      <div class="button-space">
          <a class="btn btn-success" href="/orders/new?rental_machine_id=4">貸し出す</a>
      </div>
    </li>
  
</ul>

@endsection