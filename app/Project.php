<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'name' => 'required',
        'address' => 'required',
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
    
    public function rental_machines(): BelongsToMany
    {
        return $this->belongsToMany('App\RentalMachine')->using('App\Order');
    }
    
    //rails で enum で定義しているところを、あえてクラス変数連想配列で行う　status 
    public static $statuses = [
        0 => '施工中',
        1 => '施工済み'
    ];

    //lengthほか、正規表現で組む https://qiita.com/daiti0113/items/3af7b433c58003762a37 参照 ※文字数制限も組める
    public function rules()
    {
        return[
            'name' => 'unique:projects',
            
            'name' => 'max:50',
            
            'name' => 'min:1',
            
            // 'name' => 'unique:projects | max:50| min:1',
            
            'address' => 'max:80',
        ];
    
    }
    
    public function project_full_name()
    {
        self.customer.name + '/' + self.name;
    }

}