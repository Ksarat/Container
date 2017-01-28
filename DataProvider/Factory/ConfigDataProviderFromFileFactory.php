<?php

namespace ConfigDataProvider\Factory;

use ConfigDataProvider\ConfigFileDataProvider as FileDataProvider;

/**
 * Class ConfigDataProviderFromFileFactory
 * @package ConfigDataProvider\Factory
 */
class ConfigDataProviderFromFileFactory
{
    /**
     * @param $filePath
     * @return FileDataProvider\IniDataProvider|FileDataProvider\JsonDataProvider|FileDataProvider\XmlDataProvider
     * @throws \Exceptions\WrongFileExtensionException
     */
    public static function getFileProvider($filePath)
    {
        $pathParts = pathinfo($filePath);

        switch($pathParts['extension'])
        {
            case 'xml':
               return new FileDataProvider\XmlDataProvider($filePath);
                break;
            case 'json':
                return new FileDataProvider\JsonDataProvider($filePath);
                break;
            case 'ini':
                return new FileDataProvider\IniDataProvider($filePath);
                break;
            default:
                throw new \Exceptions\WrongFileExtensionException();
        }
    }


}