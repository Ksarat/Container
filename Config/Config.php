<?php

namespace Config;

use ConfigDataProvider\ConfigDataProvider;

/**
 * Class Config
 */
class Config implements \Iterator, \ArrayAccess
{
    /** @var array */
    private $container = [];

    private static
        $instance = null;

    /**
     * Config constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * @return void
     */
    private function __sleep()
    {
    }

    /**
     * @return void
     */
    private function __wakeup()
    {
    }

    /**
     * Return the Config instance of this class.
     *
     * @return Config instance.
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Config data.
     *
     * @param ConfigDataProvider $data
     */
    public function configData(ConfigDataProvider $data)
    {
        $this->setContainer($data);
    }

    /**
     * @param ConfigDataProvider $data
     */
    public function setContainer(ConfigDataProvider $data)
    {
        if ($data = $data->getData()) {

            $this->container = array_replace_recursive($this->container, $data);
        }
    }

    /**
     * @return array
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @return object
     */
    public function getContainerAsObject()
    {
        return (object) $this->container;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return current($this->container);
    }

    /**
     * @return mixed
     */
    public function next()
    {
        return next($this->container);
    }

    /**
     * @return mixed
     */
    public function key()
    {
        return key($this->container);
    }

    /**
     * @return mixed
     */
    public function valid()
    {
        return key($this->container) !== null;
    }

    /**
     * @return mixed
     */
    public function rewind()
    {
        return reset($this->container);
    }


    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }
}
