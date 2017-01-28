<?php

namespace ConfigDataProvider\ConfigFileDataProvider;

use ConfigDataProvider\ConfigDataProvider;

/**
 * Class ConfigDataProviderFromFile
 */
abstract class ConfigDataProviderFromFile extends ConfigDataProvider
{

	/** @var string */
	protected $filePath = '';
	/** @var  null|mixed */
	protected $rawFileData;

	/**
	 * ConfigDataProviderFromFile constructor.
	 *
	 * @param $filePath
	 */
	public function __construct($filePath)
	{
		$this->filePath = trim($filePath);
	}

	/**
	 * @return bool
	 */
	protected function preProcessData()
	{
		return $this->readConfigFile();
	}

	/**
	 * @return bool
	 */
	abstract protected function readConfigFile();

	/**
	 * @return bool
	 */
	protected function isFileExist()
	{
		if (file_exists($this->filePath))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * @throws \Exceptions\WrongFileExtensionException
	 */
	protected function checkFileExtension()
	{
		$pathParts = pathinfo($this->filePath);

		if($pathParts['extension'] != static::EXTENSION)
		{
			throw new \Exceptions\WrongFileExtensionException();
		}

	}

}