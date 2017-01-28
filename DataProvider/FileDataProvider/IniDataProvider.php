<?php

namespace ConfigDataProvider\ConfigFileDataProvider;

/**
 * Class IniDataProvider
 * @package ConfigDataProvider\ConfigFileDataProvider
 */
class IniDataProvider extends ConfigDataProviderFromFile
{
	const EXTENSION = 'ini';

	/**
	 * @return mixed
	 */
	protected function preProcessData()
	{
		if (parent::preProcessData())
		{
			$this->data = $this->rawFileData;

			return true;
		}

		return false;
	}

	/**
	 * @return bool
	 * @throws \Exceptions\FileException
	 */
	protected function readConfigFile()
	{
		if (!$this->isFileExist())
		{
			return false;
		}

		$this->checkFileExtension();

		try
		{
			$this->rawFileData = parse_ini_file($this->filePath, true);

			if ($this->rawFileData === false)
			{
				throw new \Exceptions\FileException();
			}
		}
		catch (\Exceptions\FileException $e)
		{
			return false;
		}

		return true;
	}

}