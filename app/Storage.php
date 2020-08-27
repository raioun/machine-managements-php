<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
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
    
    public function branches(): BelongsToMany
    {
        return $this->belongsToMany('App\Branch')->using('App\RentalMachine'); //using≒through
    }
    
    public function machines(): BelongsToMany
    {
        return $this->belongsToMany('App\Machine')->using('App\RentalMachine');
    }
    
    public function company(){
      return $this->belongsTo('App\Company');
    }
    
    //lengthほか、正規表現で組む https://qiita.com/daiti0113/items/3af7b433c58003762a37 参照 ※文字数制限も組める
    public function rules()
    {
        return[

        ];
    
    }
    
    public function storage_full_name()
    {
        self.company.name + '/' + self.name;
    }
    

}
