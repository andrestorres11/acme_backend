<?php
namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = false; 
/**
* The attributes that are mass assignable.
*
* @var array
*/
    protected $fillable = [
        'user_identity','user_name', 'user_secName', 'user_lastName','user_cellphone','user_city', 'user_address','user_password', 'user_email','userType_id',
    ];
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'user_id', 'statu_id', 'user_encrypted', 'userType_id'
    ];
    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
        'user_creationDate' => 'datetime',
        'user_lastModification' => 'datetime',
    ];
    public function statu(){
        return $this->belongsTo( 'App\Statu', 'statu_id', 'statu_id' );
    }
    public function cars(){
        return $this->hasMany( 'App\Car', 'user_id', 'user_id' );
    }
    public function tokens(){
        return $this->hasMany( 'App\Token', 'user_id', 'user_id' );
    }
}
