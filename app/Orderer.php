<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderer extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
      'family_name' => 'required | max:10 | min:1',

      'first_name' => 'max:10',
        
      'phone_number' => 'max:20',
      // 'first_name' => 'required',
      // 'phone_number' => 'required',
    );
    
    public function orders()
    {
      return $this->hasMany('App\order');
    }
    
    public function users(): BelongsToMany
    {
      return $this->belongsToMany('App\User')->using('App\Order'); //using≒through
    }
    
    public function projects(): BelongsToMany
    {
      return $this->belongsToMany('App\Project')->using('App\Order');
    }
    
    public function rental_machines(): BelongsToMany
    {
      return $this->belongsToMany('App\RentalMachine')->using('App\Order');
    }
    
    //他のモデルでも書き漏れあり 7/25(土)追加 1対多のため、こちらの語尾にsは付けない。
    public function customer(){
      return $this->belongsTo('App\Customer');
    }
    
    //rails で enum で定義しているところを、あえてクラス変数連想配列で行う　status 
    public static $statuses = [
      0 => '在籍中',
      1 => '退社済み'
    ];
    
    // 7/25(土)追加
    public function status_name(){
      return self::$statuses[$this->status];
    }
    
    public function orderer_full_name()
    {
      self.customer.name + '/' + self.family_name + '/' + self.first_name;
    }
    
}