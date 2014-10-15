<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create("usuarios", function($table){
				$table->increments("id");
				$table->string("username");
				$table->string("nome");
				$table->string("email");
				$table->string("senha");
				$table->string("cidade")->nullable();
				$table->string("profilePicture");
				$table->boolean("status");
				$table->timestamps();
				$table->string("remember_token");
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
		Schema::drop("usuarios");
	}

}

