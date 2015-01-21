<?php namespace Ki\Common\Uploader;

use Illuminate\Support\ServiceProvider;

use Ki\Common\Uploader\Uploader;
use Ki\Common\Uploader\UploaderInterface;

class UploaderServiceProvider extends ServiceProvider {

	/**
	 * Bind the UploaderInterface
	 */
	public function register()
	{
		$this->app->bind('Ki\Common\Uploader\UploaderInterface', function($app)
		{
			return new Uploader;
		});
	}

}