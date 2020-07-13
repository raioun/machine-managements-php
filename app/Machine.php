<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'name' => 'required',
        'type1' => 'required',
        'type2' => 'required',
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
    
    
    //lengthほか、正規表現で組む https://qiita.com/daiti0113/items/3af7b433c58003762a37 参照 ※文字数制限も組める
    public function rules()
    {
        return[
            'name' => 'max:50',
            
            'name' => 'min:1',
            
            // 'name' => 'max:50| min:1',
            
            'type1' => 'max:50',
            
            'type2' => 'max:50',
        ];
    
    }
    
    public function machine_full_name()
    {
        self.name + '/' + self.type1 + '/' + self.type2;
    }
    
    
}
