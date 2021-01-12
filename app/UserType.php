<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
	protected $table = 'user_type';
	protected $primaryKey = 'userType_id';
	public $timestamps = false;



    protected $fillable = [
        'userType_name', 'userType_description',
    ];




    protected $hidden = [
        'userType_id', 'statu_id', 'userType_encrypted',
    ];


    protected $casts = [
        'userType_creationDate' => 'datetime',
        'userType_lastModification' => 'datetime',
    ];

    public function statu(){
        return $this->belongsTo( 'App\Statu', 'statu_id', 'statu_id' );
    }
}