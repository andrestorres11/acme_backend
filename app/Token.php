<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'token';
    protected $primaryKey = 'token_id';

    public $timestamps = false; 

/**
* The attributes that are mass assignable.
*
* @var array
*/
	protected $fillable = [
		
	];

/**
* The attributes that should be hidden for arrays.
*
* @var array
*/
	protected $hidden = [
		'statu_id', 'token_id', 'user_id', 'token_encrypted',
	];

/**
* The attributes that should be cast to native types.
*
* @var array
*/
	protected $casts = [
		'token_creationDate' => 'datetime',
		'token_lastModification' => 'datetime',
	];

	public function statu(){
        return $this->belongsTo( 'App\Statu', 'statu_id', 'statu_id' );
    }

    public function user(){
        return $this->belongsTo( 'App\User', 'user_id', 'user_id' );
    }
}
