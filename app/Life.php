<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
	
class Life extends Model
{
	protected $table = 'life';
	protected $primaryKey = 'life_id';
	public $timestamps = false; 
	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = [
		'car_id', 'user_id',
	];
	/**
	* The attributes that should be hidden for arrays.
	*
	* @var array
	*/
	protected $hidden = [
		'life_id', 'statu_id', 'car_id', 'user_id', 'life_encrypted',
	];
	/**
	* The attributes that should be cast to native types.
	*
	* @var array
	*/
	protected $casts = [
		'life_creationDate' => 'datetime',
		'life_lastModification' => 'datetime',
	];
	public function statu(){
		return $this->belongsTo( 'App\Statu', 'statu_id', 'statu_id' );
	}
	public function car(){
		return $this->belongsTo( 'App\Car', 'car_id', 'car_id' );
	}
	public function user(){
		return $this->belongsTo( 'App\User', 'user_id', 'user_id' );
	}
}
