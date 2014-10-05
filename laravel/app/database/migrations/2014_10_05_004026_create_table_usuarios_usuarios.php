<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuariosUsuarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create("usuario_usuario",function($table){
			$table->integer("usuario_id")->unsigned();
			$table->integer("amigo_id")->unsigned();
			$table->timestamps();
			$table->foreign("usuario_id")->references("id")->on("usuarios");
			$table->foreign("amigo_id")->references("id")->on("usuarios");

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
