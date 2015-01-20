<?php

/**
 *
 */
function _active($route, $wildcard = true)
{
	$current = Route::currentRouteName();

	if ( $wildcard )
	{
		$pieces = explode($route, '.');
		$index = 0;

		$route = array_map(function($piece) use($pieces)
		{
			if ( $piece !== $pieces[ count($pieces) - 1 ] )
			{
				return $piece;
			}
		}, $pieces);
	}

	return $route == $current;
}