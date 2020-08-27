<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'name' => 'required | max:50 | min:1',
        // 'type1' => 'required',
        // 'type2' => 'required',

        'type1' => 'max:50',
        
        'type2' => 'max:50',
    );
    
    public function rental_machines()
    {
        return $this->hasMany('App\RentalMachine');
    }

    public function branches(): BelongsToMany
    {
        return $this->belongsToMany('App\Branch')->using('App\RentalMachine'); //using≒through
    }
    
    public function storages(): BelongsToMany
    {
        return $this->belongsToMany('App\Storage')->using('App\RentalMachine'); 
    }
    
    public function machine_full_name()
    {
        self.name + '/' + self.type1 + '/' + self.type2;
    }
    
    
}
