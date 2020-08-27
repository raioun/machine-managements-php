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
  <form action="/customers/2" accept-charset="UTF-8" method="get"><input name="utf8" type="hidden" value="&#x2713;" />
  
    <div class="form-group">
      <label for="family_name_発注者名(苗字のみ)">発注者名(苗字のみ)</label>
      <input type="text" name="family_name" id="family_name" />
    </div>
    
    <div class="form-group">
      <label for="status_状態">状態</label>
      <select name="orderer[status]" id="orderer_status">
        <option value="0">在籍中</option>
        <option value="1">退社済み</option>
      </select>
    </div>
    
    <div><input type="submit" value="検索" data-disable-with="検索" /></div>
</form></div>

  <ul class="media-list">
    <li class="media">
      <div>
        <p>顧客企業名：<a href="/customers/2">日興基礎株式会社</a></p>
      </div>
      <div>
        <p>発注者名：高橋</p>
      </div>
      <div>
        <p>状態：在籍中</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orderers/1">詳細</a>
      </div>
    </li>
    <li class="media">
      <div>
        <p>顧客企業名：<a href="/customers/2">日興基礎株式会社</a></p>
      </div>
      <div>
        <p>発注者名：京増</p>
      </div>
      <div>
        <p>状態：在籍中</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orderers/4">詳細</a>
      </div>
    </li>
  
</ul>

<div class="text-center">
  <h1>この顧客企業の現場一覧</h1>
</div>
<div class="text-center">
  <h2>検索フォーム</h2>
</div>
<div class="text-center">
  <form action="/customers/2" accept-charset="UTF-8" method="get"><input name="utf8" type="hidden" value="&#x2713;" />
  
    <div class="form-group">
      <label for="project_現場名">現場名</label>
      <input type="text" name="project" id="project" />
    </div>
    
    <div><input type="submit" value="検索" data-disable-with="検索" /></div>
  </form>
</div>
<div>
  <ul class="media-list">
    <li class="media">
      <div>
        <p>顧客企業名：<a href="/customers/2">日興基礎株式会社</a></p>
      </div>
      <div>
        <p>現場名：美浜区真砂1号機</p>
      </div>
      <div>
        <p>状態：施工中</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/projects/3">詳細</a>
      </div>
    </li>
    <li class="media">
      <div>
        <p>顧客企業名：<a href="/customers/2">日興基礎株式会社</a></p>
      </div>
      <div>
        <p>現場名：大田区南六郷</p>
      </div>
      <div>
        <p>状態：施工中</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/projects/1">詳細</a>
      </div>
    </li>
  
  </ul>
</div>

@endsection