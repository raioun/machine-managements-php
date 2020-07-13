<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderer extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'family_name' => 'required',
        'first_name' => 'required',
        'phone_number' => 'required',
    );
    
    public function orders()
    {
        return $this->hasMany('App\order');
    }
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany('App\User')->using('App\Order'); //using≒through
    }
    
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany('App\Project')->using('App\Order');
    }
    
    public function rental_machines(): BelongsToMany
    {
        return $this->belongsToMany('App\RentalMachine')->using('App\Order');
    }
    
    //rails で enum で定義しているところを、あえてクラス変数連想配列で行う　status 
    public static $statuses = [
        0 => '在籍中',
        1 => '退社済み'
    ];
    
        //lengthほか、正規表現で組む https://qiita.com/daiti0113/items/3af7b433c58003762a37 参照 ※文字数制限も組める
    public function rules()
    {
        return[
            'family_name' => 'max:10',
            
            'family_name' => 'min:1',
            
            // 'family_name' => 'max:10 | min:1',
            
            'first_name' => 'max:10',
            
            'phone_number' => 'max:20',
        ];
    
    }
        
    public function orderer_full_name()
    {
        self.customer.name + '/' + self.family_name + '/' + self.first_name;
    }
    
}