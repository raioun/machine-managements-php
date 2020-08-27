<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'name' => 'required | unique:customers| max:50 | min:1',
    );
        
    public function projects()
    {
        return $this->hasMany('App\Project');
    }
    
    public function orderers()
    {
        return $this->hasMany('App\Orderer');
    }
}
