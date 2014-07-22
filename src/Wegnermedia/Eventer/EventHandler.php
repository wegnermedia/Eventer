<?php namespace Wegnermedia\Eventer;

/**
* Event Manager
*/
abstract class EventHandler
{
	/**
	 * Triggered Handle Method on Event Listener
	 *
	 * @return void
	 **/
	public function handle($event = null)
	{
		if ( ! $event ) return;

		$method = $this->getEventName($event);

		if ( method_exists($this, $method) )
		{
			return $this->$method($event);
		}
	}

	/**
	 * Get Classes Basename
	 *
	 * @return string
	 **/
	protected function getEventName($event)
	{
		$name = class_basename($event);

		// Cut off 'Event'
		$name = preg_replace("/Event$/ui", "", $name);

		// Prefix with 'when'
		$name = 'when' . $name;

		// Done
		return $name;
	}
}