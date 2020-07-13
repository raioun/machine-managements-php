<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
            'name' => 'required',
    );
        
    public function branches()
    {
        return $this->hasMany('App\Branch');
    }
    
    public function storages()
    {
        return $this->hasMany('App\Storage');
    }
    
    //lengthほか、正規表現で組む https://qiita.com/daiti0113/items/3af7b433c58003762a37 参照 ※文字数制限も組める
    public function rules()
    {
        return [
            'name' => 'unique:customers',
            
            'name' => 'max:50',
            
            'name' => 'min:1',
            
            // 'name' => 'unique:customers | max:50 | min:1',
        ];
    }
    
}
