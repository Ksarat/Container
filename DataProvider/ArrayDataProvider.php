<?php

namespace ConfigDataProvider;

/**
 * Class ArrayDataProvider
 * @package ConfigDataProvider
 */
class ArrayDataProvider extends ConfigDataProvider
{
	protected $array = [];

	public function __construct(array $array)
	{
		$this->array = $array;
	}

	/**
	 * @return mixed
	 */
	protected function preProcessData()
	{
		// TODO: просто записываем данные массива в  $this->data, предварительно можно сдеть какието проверки или валидации

		$this->data = $this->array;

		return true;
	}
}