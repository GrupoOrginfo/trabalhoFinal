<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Conversa extends Eloquent {

	//use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'conversas';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	protected $fillable = array("grupo","arquivo", "time_request");

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');


	public function pertence()
    {
        return $this->belongsToMany('Usuario','usuario_conversa','conversa_id','usuario_id');
    }
/*
    public function getAuthPassword(){

		return $this->senha;


	}

*/

}


