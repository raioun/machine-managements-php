<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentalMachine extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        // 'code' => 'required',
        // 'remarks' => 'required',
        
        'code' => 'max:10',
        'remarks' => 'max:100',
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
    
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany('App\Project')->using('App\Order');
    }
    
    public function machine(){
      return $this->belongsTo('App\Machine');
    }
    
    public function branch(){
      return $this->belongsTo('App\Branch');
    }
    
    public function storage(){
      return $this->belongsTo('App\Storage');
    }
    
    //rails で enum で定義しているところを、あえてクラス変数連想配列で行う　status 
    public static $statuses = [
        0 => '良品',
        1 => '重整備',
        2 => '廃棄済み'
    ];
    
    public function status_name(){
      return self::$statuses[$this->status];
    }
        
    // public function rental_machine_full_name()
    // {
    // '機材名：' + {{ $rental_machine->machine->name }} + '/' + {{ $rental_machine->machine->type1 }} + '/' + {{ $rental_machine->machine->type2 }} + '/' + '機番：' + {{ $rental_machine->machine->code }} + '/' + '所有営業所名：' + {{ $rental_machine->branch->company->name }} + '/' + {{ $rental_machine->branch->name }};
    // }

    
}
