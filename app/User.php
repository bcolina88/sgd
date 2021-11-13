<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'name', 'email', 'password', 'avatar', 'role_id', 'cargo', "state_id", "user_confirm", "gender", "address", "city", "country", "phone1", "phone2", "type_identification", "identification", "birthday"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
   /* public function setBirthdayAttribute($value){
        if($value != ''){
            $fecha = explode("/", $value);
            $this->attributes['birthday'] = $fecha[2]."/".$fecha["0"]."/".$fecha[1];
        }
    }
    
    public function getBirthdayAttribute($value){
        return date("m/d/Y", strtotime($value));
    }*/

    public function modulos(){
        return $this->hasMany(UserModule::class, "user_id", "id");
    }
}
