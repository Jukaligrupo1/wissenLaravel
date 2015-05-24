<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWsentidadesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ws_entidades', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('lider_id')->unsigned()->nullable();
            $table->integer('logo_id')->unsigned()->nullable();
            $table->string('telefono')->nullable();
            $table->string('alias')->nullable();
            $table->integer('evento_id')->unsigned()->nullable();
            $table->timestamps();
        });



		/*
		Nombre de las ciencias de las preguntas 
		ejemplos:
			- Matemáticas, Español, etc.
			- Apocalipsis, Daniel, etc.
		*/
		Schema::create('ws_disciplinas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->integer('evento_id')->unsigned()->nullable();
            $table->timestamps();
        });
		Schema::table('ws_disciplinas', function(Blueprint $table) {
			$table->foreign('evento_id')->references('id')->on('ws_eventos')->onDelete('cascade');
		});

		Schema::create('ws_disciplinas_traduc', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->integer('disciplina_id')->unsigned()->nullable(); // Disciplina a la que pertenece esta traducción
            $table->string('descripcion')->nullable();
            $table->integer('idioma_id')->unsigned()->nullable();
            $table->boolean('traducido_at')->nullable();
            $table->timestamps();
        });
		Schema::table('ws_disciplinas_traduc', function(Blueprint $table) {
			$table->foreign('disciplina_id')->references('id')->on('ws_disciplinas')->onDelete('cascade');
		});



		/*
		Nombre de niveles en el evento
		ejemplos:
			- A, B, etc.
			- Niño, Adulto, etc.
		*/
		Schema::create('ws_niveles', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->integer('evento_id')->unsigned()->nullable();
            $table->timestamps();
        });
		Schema::table('ws_niveles', function(Blueprint $table) {
			$table->foreign('evento_id')->references('id')->on('ws_eventos')->onDelete('cascade');
		});

		Schema::create('ws_niveles_traduc', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->integer('niveles_id')->unsigned()->nullable(); // Nivel al que pertenece esta traducción
            $table->string('descripcion')->nullable();
            $table->integer('idioma_id')->unsigned()->nullable();
            $table->boolean('traducido_at')->nullable();
            $table->timestamps();
        });
		Schema::table('ws_niveles_traduc', function(Blueprint $table) {
			$table->foreign('niveles_id')->references('id')->on('ws_niveles')->onDelete('cascade');
		});




		/*
		Nombre de categorías en el evento. Estas son la combinación entre nivel y disciplina
		ejemplos:
			- Español A, Inglés B, etc.
			- Apocalipsis (Niño), Génesis (Adulto), etc.
		*/
		Schema::create('ws_categorias', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->integer('nivel_id')->unsigned()->nullable();
            $table->integer('disciplina_id')->unsigned()->nullable();
            $table->integer('evento_id')->unsigned()->nullable();
            $table->timestamps();
        });
		Schema::table('ws_categorias', function(Blueprint $table) {
			$table->foreign('nivel_id')->references('id')->on('ws_niveles')->onDelete('cascade');
			$table->foreign('disciplina_id')->references('id')->on('ws_categorias')->onDelete('cascade');
			$table->foreign('evento_id')->references('id')->on('ws_eventos')->onDelete('cascade');
		});

		Schema::create('ws_categorias_traduc', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->integer('categoria_id')->unsigned()->nullable(); // Nivel al que pertenece esta traducción
            $table->string('descripcion')->nullable();
            $table->integer('idioma_id')->unsigned()->nullable();
            $table->boolean('traducido_at')->nullable();
            $table->timestamps();
        });
		Schema::table('ws_categorias_traduc', function(Blueprint $table) {
			$table->foreign('categoria_id')->references('id')->on('ws_categorias')->onDelete('cascade');
		});



	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ws_entidades');
		Schema::drop('ws_disciplinas');
		Schema::drop('ws_disciplinas_traduc');
		Schema::drop('ws_niveles');
		Schema::drop('ws_niveles_traduc');
		Schema::drop('ws_categorias');
		Schema::drop('ws_categorias_traduc');
	}

}
