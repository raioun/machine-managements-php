<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'name' => 'required | max:50 | min:1',
        // 'address' => 'required',
        
        'address' => 'max:80',
    );
    
    public function rental_machines()
    {
        return $this->hasMany('App\RentalMachine');
    }
    
    public function storages(): BelongsToMany
    {
        return $this->belongsToMany('App\Storage')->using('App\RentalMachine'); //using≒through
    }
    
    public function machines(): BelongsToMany
    {
        return $this->belongsToMany('App\Machine')->using('App\RentalMachine');
    }
    
    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function branch_full_name()
    {
        self.company.name + '/' + self.name;
    }
    
}
