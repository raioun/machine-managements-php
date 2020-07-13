<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'out_time' => 'required',
        'in_time' => 'required',
        'remarks' => 'required',
    );
    
    //rails で enum で定義しているところを、あえてクラス変数連想配列で行う　status 
    public static $statuses = [
        0 => '予約中',
        1 => '出庫中',
        2 => '返却済み'
    ];
    
    //lengthほか、正規表現で組む https://qiita.com/daiti0113/items/3af7b433c58003762a37 参照 ※文字数制限も組める
    public function rules()
    {
        return[
            'out_time' => 'max:20',
            
            'in_time' => 'max:20',
            
            'remarks' => 'max:100',
        ];
    
    }
    
    // 返却日付が貸出日付と同じか未来をチェックする
    // controllerの方で、$this->validate($request, Order::after_or_equal($request->out_date)) returnの処理
    public static function after_or_equal($out_date)
    {
         return ['in_date' => 'required|date|after_or_equal:' . $out_date];
    }
  
    
    // 日付重複(後で手直しで)
    // isDateDuplicationの関数をif以下に渡す$out_date,$in_date毎
    public static function isDateDuplication($out_date1, $in_date1, $out_date2, $in_date2) {
      return ($out_date1 < $in_date2 && $out_date2 < $in_date1);
    }
    
    public static function checkDateDuplication($request, $orders){
       $ret = true;
       
      // $out_date1 etcにどう値を渡す？
      
      foreach($orders as $order) {
        if (self::isDateDuplication(
          $request->out_date,
          $request->in_date,
          $order->out_date,
          $order->in_time)) {
        $ret = false;
        break;
        }
        if (self::isDateDuplication(
          $order->out_date,
          $order->in_date,
          $request->out_date,
          $request->in_date)) {
        $ret = false;
        break;
        }
      }
      return $ret;
    }
    
}
