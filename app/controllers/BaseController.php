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
	 * while allowing method chaining which makes it cooler:
	 * $this->flash()->redirect();
	 *
	 * @param string 	$key 	Session key
	 * @param string 	$value 	Session value
	 */
	protected function flash($key, $value)
	{
		\Session::flash($key, $value);

		return $this;
	}

	/**
	 * Shorthand for Redirect::whatever
	 *
	 * @param string 	$route 		Route / URL
	 * @param boolean 	$isRoute 	Option if the passed first arg is a route name or a URL
	 */
	protected function redirect($route, $isRoute = true)
	{
		return $isRoute ? Redirect::route($route) : Redirect::to($route);
	}

	/**
	 * Shorthand for Redirect::back
	 *
	 * @param 	boolean 	$withInput 	Since `back` is usually used for invalid data
	 * @return 	Redirect
	 */
	protected function back($withInput = true)
	{
		$back = Redirect::back();

		return $withInput ? $back->withInput() : $back;
	}

	/**
	 * Shorthand for Input
	 *
	 * @param mixed 	$fields 	Fields whatever.
	 * @see _is_array
	 */
	protected function input($fields = null)
	{
		return is_null($fields)
			? Input::all()
			: Input::only( _is_array($fields) ? $fields : [$fields] );
	}

	/**
	 * Shorthand for View
	 *
	 * @param string 	$view 	Path of the view
	 * @param array 	$data 	Data to be passed to the view
	 */
	protected function view($view, array $data = null)
	{
		return View::make($view, $data ?: []);
	}

	/**
	 * Auth stuff
	 *
	 * @return Auth|Model
	 */
	protected function auth()
	{
		return Auth::user();
	}
}
