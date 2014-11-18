<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuarioConversas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("usuario_conversa",function($table){
			$table->integer("usuario_id")->unsigned();
			$table->integer("conversa_id")->unsigned();
			$table->timestamps();
			$table->foreign("usuario_id")->references("id")->on("usuarios")->onDelete('cascade');
			$table->foreign("conversa_id")->references("id")->on("conversas")->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("usuario_conversa");
	}

}
