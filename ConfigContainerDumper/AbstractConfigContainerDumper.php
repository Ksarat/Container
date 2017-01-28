<?php

namespace ConfigContainerDumper;

use Config\Config;

/**
 * Class AbstractConfigContainerDumper
 * @package ConfigContainerDumper
 */
abstract class AbstractConfigContainerDumper
{
    /**
     * @var Config
     */
    protected $configObj;

    protected $convertData;

    /**
     * AbstractConfigContainerDumper constructor.
     * @param Config $configObj
     */
    public function __construct(Config $configObj)
    {
        $this->configObj = $configObj;
    }

    /**
     * @return mixed
     */
    abstract public function getDumpedContainerData();

    /**
     * @return array
     */
    protected function getContainerData()
    {
        return $this->configObj->getContainer();
    }

    public function getConvertData()
    {
        return $this->convertData;

    }

}