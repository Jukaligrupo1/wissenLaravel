<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWsexamenesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ws_examenes', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('inscripcion_id');
            $table->integer('evaluacion_id')->unsigned()->nullable();
            $table->timestamps();

            
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ws_examenes');
		
	}

}
