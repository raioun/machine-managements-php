<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentalMachine extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'code' => 'required',
        'remarks' => 'required',
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
    
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany('App\Project')->using('App\Order');
    }
    
    //rails で enum で定義しているところを、あえてクラス変数連想配列で行う　status 
    public static $statuses = [
        0 => '良品',
        1 => '重整備',
        2 => '廃棄済み'
    ];
    
    //lengthほか、正規表現で組む https://qiita.com/daiti0113/items/3af7b433c58003762a37 参照 ※文字数制限も組める
    public function rules()
    {
        return[
            'code' => 'max:10',
        ];
    
    }
        
    public function rental_machine_full_name()
    {
    '機材名：' + self.machine.name + '/' + self.machine.type1 + '/' + self.machine.type2 + '/' + '機番：' + self.code + '/' + '所有営業所名：' + self.branch.company.name + '/' + self.branch.name;
    }

    
}
