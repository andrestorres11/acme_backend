<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Statu extends Model
{
    protected $table = 'statu';
    protected $primaryKey = 'statu_id';
    public $timestamps = false; 
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'statu_name', 
    ];
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'statu_id', 'statu_encrypted'
    ];
    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
        'statu_creationDate' => 'datetime',
        'statu_lastModification' => 'datetime',
    ];
    public function cars(){
        return $this->hasMany( 'App\Car', 'statu_id', 'statu_id' );
    }
    public function lifes(){
        return $this->hasMany( 'App\Life', 'statu_id', 'statu_id' );
    }
    public function users(){
        return $this->hasMany( 'App\User', 'statu_id', 'statu_id' );
    }
    public function tokens(){
        return $this->hasMany( 'App\Token', 'statu_id', 'statu_id' );
    }
}
