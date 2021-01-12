<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model

{
	protected $table = 'car';
	protected $primaryKey = 'car_id';
	public $timestamps = false; 
	/**

	* The attributes that are mass assignable.

	*

	* @var array

	*/

	protected $fillable = [
		'car_licensePlate', 'car_brand', 'car_color','car_type','user_id',
	];
	/**
	* The attributes that should be hidden for arrays.
	*
	* @var array
	*/
	protected $hidden = [
		'statu_id', 'car_encrypted', 'user_id',
	];
	/**
	* The attributes that should be cast to native types.
	*
	* @var array
	*/
	protected $casts = [
		'car_creationDate' => 'datetime',
		'car_lastModification' => 'datetime',
	];
	public function statu(){
		return $this->belongsTo( 'App\Statu', 'statu_id', 'statu_id' );
	}
	public function user(){
		return $this->belongsTo( 'App\User', 'user_id', 'user_id' );
	}
	public function lifes(){
		return $this->hasMany( 'App\Life', 'car_id', 'car_id' );
	}
}