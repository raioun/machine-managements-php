<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        // 'out_time' => 'required',
        // 'in_time' => 'required',
        // 'remarks' => 'required',
        
        'out_time' => 'max:20',
        'in_time' => 'max:20',
        'remarks' => 'max:100',
    );

    public function user(){
      return $this->belongsTo('App\User');
    }
    
    public function project(){
      return $this->belongsTo('App\Project');
    }
    
    public function orderer(){
      return $this->belongsTo('App\Orderer');
    }
    
    public function rental_machine(){
      return $this->belongsTo('App\RentalMachine');
    }
    
    //rails で enum で定義しているところを、あえてクラス変数連想配列で行う　status 
    public static $statuses = [
        0 => '予約中',
        1 => '出庫中',
        2 => '返却済み'
    ];
    
    public function status_name(){
      return self::$statuses[$this->status];
    }
    
    // 返却日付が貸出日付と同じか未来をチェックする(rubyでいうon_or_after)
    // controllerの方で、$this->validate($request, Order::after_or_equal($request->out_date)) returnの処理
    public static function after_or_equal($out_date)
    {
         return ['in_date' => 'required|date|after_or_equal:' . $out_date];
    }
  
    
    // 日付重複(後で手直しで)
    // isDateDuplicationの関数をif以下に渡す$out_date,$in_date毎  古い日付 <= 新しい日付
    // database内では、dateは - 区切りになっているため、/ 区切りから - 区切りへと文字列を置き換えなければならない。
    
    public static function isDateDuplication($out_date1, $in_date1, $out_date2, $in_date2) {
      $out1 = str_replace("/", "-", $out_date1);
      $in1 = str_replace("/", "-", $in_date1);
      $out2 = str_replace("/", "-", $out_date2);
      $in2 = str_replace("/", "-", $in_date2); 
      // $arr = [$out1, $in1, $out2, $in2];
      // dd($arr);
      return ($out2 <= $in1 && $out1 <= $in2);
    }
    
    public static function checkDateDuplication($request){
      $ret = null;
      
      //編集前の自身データとの重複解消 　　　　　　　　　　　　　　　　　　　　↓ whereNotIn('$request->id')に変えても多分OK
      $orders = self::where('rental_machine_id', $request->rental_machine_id)->where('id', '!=', $request->id)->get();

      // 重複した案件がない状態
      $dup = null;
      
      foreach($orders as $order) {
        if (self::isDateDuplication(
          $request->out_date,
          $request->in_date,
          $order->out_date,
          $order->in_date)) {
          // 日付重複していない、rental_machine_idが同じ案件が以下の$orderに残ってしまっているのでは？
          $dup = $order;
        break;
        }
        // if (self::isDateDuplication(
        //   $order->out_date,
        //   $order->in_date,
        //   $request->out_date,
        //   $request->in_date)) {
        //   $dup = $order;
        // break;
        // }
      }
      
      // $dup = $order で重複した案件があった場合、↓のif文に飛ぶ。なければそのままreturnまで飛ぶ。
      if($dup){
        $ret = '出庫日(' . $dup->out_date . ') 入庫日(' . $dup->in_date . ')の案件と期間が重複しています。';
      }
      return $ret;
    }
    
    // これもう要らない？
    public function out_date_text(){
      $this->out_date->format('Y-m-d');
    }
    
}
