<?php

namespace ConfigDataProvider;

/**
 * Class ConfigDataProvider
 */
abstract class ConfigDataProvider
{
	/** @var array */
	protected $data = [];

	/**
	 * @return bool
	 */
	 protected function preProcessData()
	{
		return true;
	}

	/**
	 * @return array
	 */
	public function getData()
	{
		if ($this->preProcessData())
		{
			return $this->data;
		}

		return [];
	}

}
