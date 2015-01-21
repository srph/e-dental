<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * Shorthand for Session::flash ($this->flash is awesome)
	 * @param string 	$key 	Session key
	 * @param string 	$value 	Session value
	 */
	protected function flash($key, $value)
	{
		\Session::flash($key, $value);
	}

}
