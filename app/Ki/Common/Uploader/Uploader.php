<?php namespace Ki\Common\Uploader;

use Ki\Common\Uploader\UploadFailedException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Uploader {

	/**
	 * Default upload path
	 */
	const UPLOAD_PATH = '/uploads';

	/**
	 * Upload the file
	 * @param UploadedFile 	$file 	File to be uploaded
	 * @param string 		$path 	Directory to store the file
	 */
	public function upload(UploadedFile $file, $path = null)
	{
		$extension = $file->getClientOriginalExtension();
		$filename = $this->getFilename($extension);
		$path = $this->getPath($path);

		if ( !$file->move($path, $filename) )
		{
			throw new UploadFailedException('Unable to upload the file');
		}
	}

	/**
	 * @param string 	$path 	Optional, new path to be used
	 * @return 	string
	 */
	protected function getPath($path = null)
	{
		$path = $path ?: self::UPLOAD_PATH;

		return \public_path($path);
	}

	/**
	 * @param string 	$extension 	File extension
	 * @param int 		$count 		Count for the randomized string
	 * @return string
	 */
	protected function getFilename($extension, $count = 25)
	{
		$string = \str_rand($count);

		return "{$string}.{$extension}";
	}

}