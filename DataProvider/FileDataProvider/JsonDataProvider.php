<?php

namespace ConfigDataProvider\ConfigFileDataProvider;

/**
 * Class JsonDataProvider
 * @package ConfigDataProvider\ConfigFileDataProvider
 */
class JsonDataProvider extends ConfigDataProviderFromFile
{
	const EXTENSION = 'json';

	/**
	 * @return mixed
	 */
	protected function preProcessData()
	{
		if (parent::preProcessData())
		{
			$parsedJson = $this->getParsedJsonData();
			$this->data = $parsedJson;

			return true;
		}

		return false;
	}

	/**
	 * @return mixed
	 */
	private function getParsedJsonData()
	{
		$resultArray = json_decode($this->rawFileData, true);
		return $resultArray;
	}

    /**
     * @return bool
     * @throws \Exceptions\WrongFileExtensionException
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
			$this->rawFileData = file_get_contents($this->filePath);

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