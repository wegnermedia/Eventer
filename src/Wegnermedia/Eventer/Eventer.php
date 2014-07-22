<?php namespace Wegnermedia\Eventer;

use Illuminate\Events\Dispatcher;

/**
* Event Manager
*/
class Eventer
{
	/**
	 * Stack of pending Events
	 *
	 * @var array
	 **/
	protected $stack = array();

	/**
	 * Instance of Laravels Event Dispatcher
	 *
	 * @var object
	 **/
	protected $event;

	function __construct(Dispatcher $event)
	{
		$this->event = $event;
	}

	/**
	 * Put Event to Stack
	 *
	 * @return this
	 **/
	public function raise($event)
	{
		$this->stack[] = $event;

		return $this;
	}

	/**
	 * Dispatch Event Stack
	 *
	 * @return this
	 **/
	public function dispatch()
	{
		// Proceed Only if there are Events
		// In Stack Array
		if ( empty($this->stack) ) return $this;

		// Cache Events
		$events = $this->stack;

		// Reset the Stack
		$this->stack = array();

		// Fire, fire, fire ...
		foreach($events as $event)
		{
			$name = strtolower(str_replace("\\", '.', get_class($event)));

			$this->event->fire($name, $event);
		}

		// Done ...
		return $this;
	}

	/**
	 * Returns the current Stack
	 *
	 * @return array
	 **/
	public function stack()
	{
		return $this->stack;
	}
}