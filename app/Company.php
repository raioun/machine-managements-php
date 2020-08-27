<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'name' => 'required | unique:companies| max:50 | min:1',
    );
        
    public function branches()
    {
        return $this->hasMany('App\Branch');
    }
    
    public function storages()
    {
        return $this->hasMany('App\Storage');
    }

}
