<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWsevaluacionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//EVALUACION -> Cuestionario ordenado de preguntas 
		Schema::create('ws_evaluaciones', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('categoria_id')->unsigned()->nullable();
            $table->integer('evento_id')->unsigned()->nullable();
            $table->integer('dirigido')->unsigned()->nullable(); // si es dirigido, es una final, si es false, es una eliminatoria
            $table->integer('descripcion')->nullable();
            $table->integer('duracion_preg')->nullable(); // en segundos. Duracion de la pregunta si el examen es dirigido y la pregunta no tiene duracion asignada;
            $table->integer('duracion_exam')->nullable(); // en minutos. Duracion del examen si es Independiente
            $table->boolean('one_by_one')->nullable(); // se responde una pregunta a la vez
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();
        });

		Schema::table('ws_evaluaciones', function(Blueprint $table) {
			$table->foreign('categoria_id')->references('id')->on('ws_categorias')->onDelete('cascade');
			$table->foreign('evento_id')->references('id')->on('ws_eventos')->onDelete('cascade');
			$table->foreign('created_by')->references('id')->on('ws_users')->onDelete('cascade');
		});

		//PREGUNTA EVALUACION 
		Schema::create('ws_pregunta_evaluacion', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('evaluacion_id')->unsigned()->nullable();
            $table->integer('tipo_preg')->unsigned()->nullable(); 
            $table->integer('pregunta_id')->nullable()->nullable(); //puede ser el cualquier id de cualquier tabla pregunta
            $table->integer('added_by')->unsigned()->nullable();
            $table->timestamps();
        });
		Schema::table('ws_pregunta_evaluacion', function(Blueprint $table) {
			$table->foreign('evaluacion_id')->references('id')->on('ws_evaluaciones')->onDelete('cascade');
			$table->foreign('added_by')->references('id')->on('ws_users')->onDelete('cascade');
		});


		

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ws_evaluaciones');
		Schema::drop('ws_pregunta_evaluacion');
		
	}

}
