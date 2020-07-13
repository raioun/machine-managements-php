<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'name' => 'required',
        'address' => 'required',
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
    
    //lengthほか、正規表現で組む https://qiita.com/daiti0113/items/3af7b433c58003762a37 参照 ※文字数制限も組める
    public function rules()
    {
        return[
            'name' => 'max:50',
            
            'name' => 'min:1',
            
            // 'name' => 'max:50| min:1',
            
            'address' => 'max:80',
        ];
    
    }
    
    public function branch_full_name()
    {
        self.company.name + '/' + self.name;
    }
    
}
