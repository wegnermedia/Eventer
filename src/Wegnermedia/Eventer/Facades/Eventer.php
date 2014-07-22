<?php namespace Wegnermedia\Eventer\Facades;

use Illuminate\Support\Facades\Facade;

class Eventer extends Facade {

	// Return Name of Binding in IoC Container
	protected static function getFacadeAccessor()
	{
		return "Wegnermedia\Eventer\Eventer";
	}

}