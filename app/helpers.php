<?php

/**
 *
 */
function _active($route)
{
	return ( Request::is($route) ) ? 'class' : '';
}