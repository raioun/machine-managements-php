<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
      'name' => 'required | max:50 | min:1',

      // 'address' => 'required',
       'address' => 'max:80',
    );
    
    public function orders()
    {
      return $this->hasMany('App\order');
    }
    
    public function users(): BelongsToMany
    {
      return $this->belongsToMany('App\User')->using('App\Order'); //using≒through
    }
    
    public function orderers(): BelongsToMany
    {
      return $this->belongsToMany('App\Orderer')->using('App\Order');
    }
    
    public function rental_machines(): BelongsToMany
    {
      return $this->belongsToMany('App\RentalMachine')->using('App\Order');
    }
    
    public function customer(){
      return $this->belongsTo('App\Customer');
    }
    
    //rails で enum で定義しているところを、あえてクラス変数連想配列で行う　status 
    public static $statuses = [
      0 => '施工中',
      1 => '施工済み'
    ];
    
    // 7/25(土)追加のorderersより
    public function status_name(){
      return self::$statuses[$this->status];
    }
    
    public function project_full_name()
    {
      self.customer.name + '/' + self.name;
    }

}