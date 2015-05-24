<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Evento;

use Illuminate\Http\Request;

class EventosController extends Controller {


	public function getIndex()
	{
		$event = Evento::all();
		return $event;
	}


	public function create()
	{
		//
	}

	
	public function postStore()
	{
		//
	}

	
	public function getShow($id)
	{
		return Evento::all();
	}

	
	public function edit($id)
	{
		//
	}

	
	public function putUpdate($id)
	{
		//
	}


	public function deleteDestroy($id)
	{
		//
	}

}
