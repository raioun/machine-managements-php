<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // /**
    //  * The attributes that should be cast to native types.
    //  *
    //  * @var array
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
    
    public static $rules = array(
            'name' => 'required | unique:users| max:50 | min:1',
            'password' => 'required',
    );
    
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany('App\Project')->using('App\Order'); //using≒through
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
        0 => '在籍中',
        1 => '退社済み'
    ];
    
    public function status_name(){
      return self::$statuses[$this->status];
    }
}
