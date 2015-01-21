<?php namespace Ki\Common\Uploader;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface UploaderInterface {

	/**
	 * Upload the file
	 */
	public function upload(UploadedFile $file, $path = null);

}