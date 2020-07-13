<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
            'name' => 'required',
    );
        
    public function projects()
    {
        return $this->hasMany('App\Project');
    }
    
    public function orderers()
    {
        return $this->hasMany('App\Orderer');
    }
    
    //lengthほか、正規表現で組む https://qiita.com/daiti0113/items/3af7b433c58003762a37 参照 ※文字数制限も組める
    public function rules()
    {
        return [
            'name' => 'unique:customers',
            
            'name' => 'max:50',
            
            'name' => 'min:1',
            
            // 'name' => 'unique:customers | max:50| min:1',
        ];
    }
    
}
