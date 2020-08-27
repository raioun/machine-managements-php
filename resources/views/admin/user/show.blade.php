@extends('layouts.admin')

@section('title', 'ユーザ詳細')
@section('content')

<h1>ユーザID：{{ $user->id }}の詳細ページ</h1>
<div>
  <p>ユーザ名：{{ $user->name }}</p>
</div>
<div>
  <p>状態：{{ $user->status_name() }}</p>
</div>
<div>
  <a class="btn btn-warning" href="/admin/users/edit?id={{ $user->id }}">編集</a>
</div>

<div class ="text-center">
  <p><a href="/admin/users">ユーザ一覧へ戻る</a></p>
</div>

<div class="text-center">
  <h1>このユーザが応対している案件一覧</h1>
</div>
<div class="text-center">
  <h2>検索フォーム</h2>
</div>


<div class="text-center">
  <form action="/users/1" accept-charset="UTF-8" method="get"><input name="utf8" type="hidden" value="&#x2713;" />
  
    <div class="form-group">
      <label for="status_状態">状態</label>
      <select name="order[status]" id="order_status">
        <option value="0">予約中</option>
        <option value="1">出庫中</option>
        <option value="2">返却済み</option></select>
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
</form></div>

<ul class="media-list">
    <li class="media">
      <div>
        <p>案件ID：8/状態：予約中</p>
      </div>
      <div>
        <p>出庫日時：2019-07-01//入庫日時：2019-07-30/</p>
      </div>
      <div>
        <p>応対者：<a href="/users/1">田中太郎</a></p>
      </div>
      <div>
        <p>顧客名：<a href="/customers/2">日興基礎株式会社</a>/現場名：<a href="/projects/1">大田区南六郷</a></p>
      </div>
      <div>
        <p>機材名：<a href="/machines/9">スタンドパイプ</a>/<a href="/machines/9">Φ2000</a>/<a href="/machines/9">6m</a></p>
      </div>
      <div>
        <p>機番：<a href="/rental_machines/4"></a></p>
      </div>
      <div>
        <p>備考欄：</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orders/8">詳細</a>
      </div>
    </li>
    <li class="media">
      <div>
        <p>案件ID：6/状態：予約中</p>
      </div>
      <div>
        <p>出庫日時：2019-07-02/積み置き/入庫日時：2019-07-30/</p>
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
        <p>機番：<a href="/rental_machines/2">102</a></p>
      </div>
      <div>
        <p>備考欄：仮おさえ</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orders/6">詳細</a>
      </div>
    </li>
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
        <p>案件ID：13/状態：予約中</p>
      </div>
      <div>
        <p>出庫日時：2019-09-08//入庫日時：2019-09-08/</p>
      </div>
      <div>
        <p>応対者：<a href="/users/1">田中太郎</a></p>
      </div>
      <div>
        <p>顧客名：<a href="/customers/2">日興基礎株式会社</a>/現場名：<a href="/projects/1">大田区南六郷</a></p>
      </div>
      <div>
        <p>機材名：<a href="/machines/9">スタンドパイプ</a>/<a href="/machines/9">Φ2000</a>/<a href="/machines/9">6m</a></p>
      </div>
      <div>
        <p>機番：<a href="/rental_machines/4"></a></p>
      </div>
      <div>
        <p>備考欄：</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orders/13">詳細</a>
      </div>
    </li>
    <li class="media">
      <div>
        <p>案件ID：15/状態：予約中</p>
      </div>
      <div>
        <p>出庫日時：2019-09-22//入庫日時：2019-09-22/</p>
      </div>
      <div>
        <p>応対者：<a href="/users/1">田中太郎</a></p>
      </div>
      <div>
        <p>顧客名：<a href="/customers/2">日興基礎株式会社</a>/現場名：<a href="/projects/1">大田区南六郷</a></p>
      </div>
      <div>
        <p>機材名：<a href="/machines/10">スタンドパイプ</a>/<a href="/machines/10">Φ1800</a>/<a href="/machines/10">6m</a></p>
      </div>
      <div>
        <p>機番：<a href="/rental_machines/6"></a></p>
      </div>
      <div>
        <p>備考欄：</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orders/15">詳細</a>
      </div>
    </li>
    <li class="media">
      <div>
        <p>案件ID：9/状態：予約中</p>
      </div>
      <div>
        <p>出庫日時：2019-11-11//入庫日時：2019-12-11/</p>
      </div>
      <div>
        <p>応対者：<a href="/users/1">田中太郎</a></p>
      </div>
      <div>
        <p>顧客名：<a href="/customers/2">日興基礎株式会社</a>/現場名：<a href="/projects/1">大田区南六郷</a></p>
      </div>
      <div>
        <p>機材名：<a href="/machines/9">スタンドパイプ</a>/<a href="/machines/9">Φ2000</a>/<a href="/machines/9">6m</a></p>
      </div>
      <div>
        <p>機番：<a href="/rental_machines/4"></a></p>
      </div>
      <div>
        <p>備考欄：</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orders/9">詳細</a>
      </div>
    </li>
    <li class="media">
      <div>
        <p>案件ID：10/状態：予約中</p>
      </div>
      <div>
        <p>出庫日時：2019-11-19//入庫日時：2019-12-19/</p>
      </div>
      <div>
        <p>応対者：<a href="/users/1">田中太郎</a></p>
      </div>
      <div>
        <p>顧客名：<a href="/customers/1">菅原建設株式会社</a>/現場名：<a href="/projects/2">常盤橋</a></p>
      </div>
      <div>
        <p>機材名：<a href="/machines/2">Wケーシング</a>/<a href="/machines/2">φ1000</a>/<a href="/machines/2">1cc</a></p>
      </div>
      <div>
        <p>機番：<a href="/rental_machines/2">102</a></p>
      </div>
      <div>
        <p>備考欄：</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orders/10">詳細</a>
      </div>
    </li>
    <li class="media">
      <div>
        <p>案件ID：22/状態：予約中</p>
      </div>
      <div>
        <p>出庫日時：2020-02-03//入庫日時：2020-02-03/</p>
      </div>
      <div>
        <p>応対者：<a href="/users/1">田中太郎</a></p>
      </div>
      <div>
        <p>顧客名：<a href="/customers/3">株式会社亀岡興業</a>/現場名：<a href="/projects/4">大田区南六郷</a></p>
      </div>
      <div>
        <p>機材名：<a href="/machines/2">Wケーシング</a>/<a href="/machines/2">φ1000</a>/<a href="/machines/2">1cc</a></p>
      </div>
      <div>
        <p>機番：<a href="/rental_machines/5">1</a></p>
      </div>
      <div>
        <p>備考欄：</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orders/22">詳細</a>
      </div>
    </li>
    <li class="media">
      <div>
        <p>案件ID：23/状態：予約中</p>
      </div>
      <div>
        <p>出庫日時：2020-02-03//入庫日時：2020-02-03/</p>
      </div>
      <div>
        <p>応対者：<a href="/users/1">田中太郎</a></p>
      </div>
      <div>
        <p>顧客名：<a href="/customers/3">株式会社亀岡興業</a>/現場名：<a href="/projects/4">大田区南六郷</a></p>
      </div>
      <div>
        <p>機材名：<a href="/machines/10">スタンドパイプ</a>/<a href="/machines/10">Φ1800</a>/<a href="/machines/10">6m</a></p>
      </div>
      <div>
        <p>機番：<a href="/rental_machines/6"></a></p>
      </div>
      <div>
        <p>備考欄：</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orders/23">詳細</a>
      </div>
    </li>
    <li class="media">
      <div>
        <p>案件ID：24/状態：予約中</p>
      </div>
      <div>
        <p>出庫日時：2020-02-03//入庫日時：2020-02-03/</p>
      </div>
      <div>
        <p>応対者：<a href="/users/1">田中太郎</a></p>
      </div>
      <div>
        <p>顧客名：<a href="/customers/3">株式会社亀岡興業</a>/現場名：<a href="/projects/4">大田区南六郷</a></p>
      </div>
      <div>
        <p>機材名：<a href="/machines/9">スタンドパイプ</a>/<a href="/machines/9">Φ2000</a>/<a href="/machines/9">6m</a></p>
      </div>
      <div>
        <p>機番：<a href="/rental_machines/4"></a></p>
      </div>
      <div>
        <p>備考欄：</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orders/24">詳細</a>
      </div>
    </li>
    <li class="media">
      <div>
        <p>案件ID：1/状態：予約中</p>
      </div>
      <div>
        <p>出庫日時：2020-07-02//入庫日時：2020-07-30/</p>
      </div>
      <div>
        <p>応対者：<a href="/users/1">田中太郎</a></p>
      </div>
      <div>
        <p>顧客名：<a href="/customers/1">菅原建設株式会社</a>/現場名：<a href="/projects/2">常盤橋</a></p>
      </div>
      <div>
        <p>機材名：<a href="/machines/9">スタンドパイプ</a>/<a href="/machines/9">Φ2000</a>/<a href="/machines/9">6m</a></p>
      </div>
      <div>
        <p>機番：<a href="/rental_machines/4"></a></p>
      </div>
      <div>
        <p>備考欄：</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orders/1">詳細</a>
      </div>
    </li>
    <li class="media">
      <div>
        <p>案件ID：17/状態：予約中</p>
      </div>
      <div>
        <p>出庫日時：2021-10-05//入庫日時：2021-10-05/</p>
      </div>
      <div>
        <p>応対者：<a href="/users/1">田中太郎</a></p>
      </div>
      <div>
        <p>顧客名：<a href="/customers/2">日興基礎株式会社</a>/現場名：<a href="/projects/1">大田区南六郷</a></p>
      </div>
      <div>
        <p>機材名：<a href="/machines/9">スタンドパイプ</a>/<a href="/machines/9">Φ2000</a>/<a href="/machines/9">6m</a></p>
      </div>
      <div>
        <p>機番：<a href="/rental_machines/4"></a></p>
      </div>
      <div>
        <p>備考欄：</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orders/17">詳細</a>
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
        <p>顧客名：<a href="/customers/3">株式会社亀岡興業</a>/現場名：<a href="/projects/4">大田区南六郷</a></p>
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
    <li class="media">
      <div>
        <p>案件ID：18/状態：予約中</p>
      </div>
      <div>
        <p>出庫日時：2022-10-05//入庫日時：2022-10-05/</p>
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
        <p>機番：<a href="/rental_machines/1">101</a></p>
      </div>
      <div>
        <p>備考欄：</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orders/18">詳細</a>
      </div>
    </li>
    <li class="media">
      <div>
        <p>案件ID：19/状態：予約中</p>
      </div>
      <div>
        <p>出庫日時：2022-10-05//入庫日時：2022-10-05/</p>
      </div>
      <div>
        <p>応対者：<a href="/users/1">田中太郎</a></p>
      </div>
      <div>
        <p>顧客名：<a href="/customers/2">日興基礎株式会社</a>/現場名：<a href="/projects/1">大田区南六郷</a></p>
      </div>
      <div>
        <p>機材名：<a href="/machines/10">スタンドパイプ</a>/<a href="/machines/10">Φ1800</a>/<a href="/machines/10">6m</a></p>
      </div>
      <div>
        <p>機番：<a href="/rental_machines/6"></a></p>
      </div>
      <div>
        <p>備考欄：</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orders/19">詳細</a>
      </div>
    </li>
    <li class="media">
      <div>
        <p>案件ID：21/状態：予約中</p>
      </div>
      <div>
        <p>出庫日時：2022-10-13//入庫日時：2022-10-13/</p>
      </div>
      <div>
        <p>応対者：<a href="/users/1">田中太郎</a></p>
      </div>
      <div>
        <p>顧客名：<a href="/customers/3">株式会社亀岡興業</a>/現場名：<a href="/projects/4">大田区南六郷</a></p>
      </div>
      <div>
        <p>機材名：<a href="/machines/2">Wケーシング</a>/<a href="/machines/2">φ1000</a>/<a href="/machines/2">1cc</a></p>
      </div>
      <div>
        <p>機番：<a href="/rental_machines/7">W928</a></p>
      </div>
      <div>
        <p>備考欄：</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orders/21">詳細</a>
      </div>
    </li>
    <li class="media">
      <div>
        <p>案件ID：7/状態：出庫中</p>
      </div>
      <div>
        <p>出庫日時：2019-06-22//入庫日時：2019-06-26/</p>
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
        <p>機番：<a href="/rental_machines/1">101</a></p>
      </div>
      <div>
        <p>備考欄：</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orders/7">詳細</a>
      </div>
    </li>
    <li class="media">
      <div>
        <p>案件ID：16/状態：出庫中</p>
      </div>
      <div>
        <p>出庫日時：2019-09-29//入庫日時：2019-10-29/</p>
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
        <p>機番：<a href="/rental_machines/7">W928</a></p>
      </div>
      <div>
        <p>備考欄：</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/orders/16">詳細</a>
      </div>
    </li>
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