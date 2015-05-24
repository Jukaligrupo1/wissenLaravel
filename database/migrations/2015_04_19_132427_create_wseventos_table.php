<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWseventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ws_eventos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->integer('examen_actual_id')->unsigned()->nullable();
            $table->boolean('with_pay')->nullable();
            $table->integer('precio1')->nullable();
            $table->integer('precio2')->nullable();
            $table->integer('precio3')->nullable();
            $table->integer('precio4')->nullable();
            $table->integer('precio5')->nullable();
            $table->boolean('allow_cross_users')->nullable();
            $table->boolean('enable_public_chat')->nullable();
            $table->boolean('enable_private_chat')->nullable();
            $table->timestamps();
        });

		//NIVEL DE PARTICIPANTES
		Schema::create('ws_nivel_participante', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nivel_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamps();
        });
		Schema::table('ws_nivel_participante', function(Blueprint $table) {
			$table->foreign('nivel_id')->references('id')->on('ws_categorias')->onDelete('cascade');
		});

		//INSCRIPCIONES
		Schema::create('ws_inscripciones', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('categoria_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable(); 
            $table->boolean('allow_to_answer')->nullable()->default(true); //cuando el participante haga 
            $table->integer('signed_by')->unsigned()->nullable();
            $table->timestamps();
        });
		Schema::table('ws_inscripciones', function(Blueprint $table) {
			$table->foreign('categoria_id')->references('id')->on('ws_categorias')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('ws_users')->onDelete('cascade');
			$table->foreign('signed_by')->references('id')->on('ws_users')->onDelete('cascade');
		});


		//USER EVENT
		Schema::create('ws_user_event', function(Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->unsigned()->nullable();
            $table->integer('event_id')->unsigned()->nullable();
            $table->integer('pagado')->unsigned(); //Dinero pagado por el usuario 
            $table->integer('signed_by')->unsigned()->nullable();
            $table->timestamps();
        });
		Schema::table('ws_user_event', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('ws_users')->onDelete('cascade');
			$table->foreign('event_id')->references('id')->on('ws_events')->onDelete('cascade');
			$table->foreign('signed_by')->references('id')->on('ws_users')->onDelete('cascade');

		});

		


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ws_eventos');
		Schema::drop('ws_nivel_participante');
		Schema::drop('ws_inscripciones');
		Schema::drop('ws_user_event');
		
	}

}
