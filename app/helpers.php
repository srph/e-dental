<?php

/**
 *
 */
function _active($route, $wildcard = true)
{
	$current = Route::currentRouteName();

	if ( $wildcard )
	{
		$pieces = explode('.', $current);

		$current = implode('.', array_map(function($piece) use($pieces)
		{
			if ( $piece !== $pieces[ count($pieces) - 1 ] )
			{
				return $piece;
			}
		}, $pieces));

		$current = substr($current, 0, strlen($current) - 1);
	}

	return $route == $current ? 'active' : '';
}