<?php

namespace ConfigDataProvider\ConfigFileDataProvider;

/**
 * Class XmlDataProvider
 * @package ConfigDataProvider\ConfigFileDataProvider
 */
class XmlDataProvider extends ConfigDataProviderFromFile
{

	const EXTENSION = 'xml';

	/**
	 * @return bool
	 */
	protected function preProcessData()
	{
		if (parent::preProcessData())
		{
			$parsedXml = new \SimpleXMLElement($this->rawFileData);
			$formedData = $this->getSimplyForExampleArrayFromXml($parsedXml);
			$this->data = $formedData;

			return true;
		}

		return false;
	}

	/**
	 * @param \SimpleXMLElement $parsedXml
	 *
	 * @return array
	 */
	private function getSimplyForExampleArrayFromXml(\SimpleXMLElement $parsedXml)
	{
		$json_string = json_encode($parsedXml);
		$resultArray = json_decode($json_string, true);

		return $resultArray;
	}

	/**
	 * @return bool
	 * @throws \Exception
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