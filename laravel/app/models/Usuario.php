<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usuarios';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	protected $fillable = array("nome","senha", "email", "time_request");

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


	public function euFizAmizadeCom()
    {
        return $this->belongsToMany('Usuario','usuario_usuario','usuario_id','amigo_id');
    }

    public function fezAmizadeComigo(){
    	return $this->belongsToMany("Usuario","usuario_usuario","amigo_id","usuario_id");
    }

    public function minhasConversas(){
    	return $this->belongsToMany("Conversa","usuario_conversa","usuario_id","conversa_id");
    }

    public function getAuthPassword(){

		return $this->senha;


	}

}


