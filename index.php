<?php

/** Base path  */
define('BASE_PATH', __DIR__ . DIRECTORY_SEPARATOR);

/** Require composer vendor autoLoader */

require_once BASE_PATH . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Config\Config;

use ConfigDataProvider\ConfigFileDataProvider as FileDataProvider;
use ConfigDataProvider as DataProvider;
use ConfigContainerDumper as Dumper;
use ConfigDataProvider\Factory\ConfigDataProviderFromFileFactory;

/** @var Config $mainConfigObj singleton*/
$mainConfigObj = Config::getInstance();

/**
 * Its possible to use Factory
 */
$requiredObjectToParse = ConfigDataProviderFromFileFactory::getFileProvider('testLoadFiles/xmlTest.xml');

$mainConfigObj->setContainer($requiredObjectToParse);

/**
 * Or instead use exact Provider
 */

/** @var FileDataProvider\XmlDataProvider $configProvider get data xml */
$configProvider = new FileDataProvider\XmlDataProvider('testLoadFiles/xmlTest.xml');

$mainConfigObj->configData($configProvider);

/**
 * работа сервера или скрипта, и тут нужно внести коррктировки в конфиг например php массив
 */
/**
 *  set Json
 */
$configJsonProvider = new FileDataProvider\JsonDataProvider('testLoadFiles/testJSON.json');
$mainConfigObj->setContainer($configJsonProvider);

/**
 *  set INI
 */
$configIniProvider = new FileDataProvider\IniDataProvider('testLoadFiles/testIni.ini');
$mainConfigObj->setContainer($configIniProvider);

/**
 * set Array
 */
$mainArrayParams = [
    'db' => ['host' => 'localhost', 'user' => 'root', 'passw' => ''],
    'api' => ['api_key' => 'asd435435dfgd3KMKjsd', 'user' => 'Taras', 'friend' => 'maybe']
];

$configIniProvider = new DataProvider\ArrayDataProvider($mainArrayParams);
$mainConfigObj->setContainer($configIniProvider);

/**
 * As Iterator
 */
foreach ($mainConfigObj as $key => $value) {

    /**
     * do something with data
     */
    $iteratorValue = $value;
}

/**
 * Array Access
 */
$accessAsToArray = $mainConfigObj['db'];

/**
 * Object Access
 */
$accessAsToObj = $mainConfigObj->getContainerAsObject();
$accessAsToObjData = $accessAsToObj->db['host'];


/**
 * Dump container data as XML
 */
$xmlDumper = new Dumper\XmlConfigContainerDumper($mainConfigObj);
$xmlDumpedData =  $xmlDumper->getDumpedContainerData();
/**
 * uncomment to downLoadFile
 */
//$xmlDumper->downloadDumpAsFile();

/**
 * Dump container data as JSON
 */
$jsonDumper = new Dumper\JsonConfigContainerDumper($mainConfigObj);
$jsonDumperData =  $jsonDumper->getDumpedContainerData();
/**
 * uncomment to downLoadFile
 */
//$jsonDumper->downloadDumpAsFile();

/**
 * Dump container data as INI
 */
$iniDumper = new Dumper\IniConfigContainerDumper($mainConfigObj);
$iniDumperData =  $iniDumper->getDumpedContainerData();
/**
 * uncomment to downLoadFile
 */
//$iniDumper->downloadDumpAsFile();

/**
 * Dump container data as Array
 */
$arrayDumper = new Dumper\ArrayConfigContainerDumper($mainConfigObj);
$arrayDumperData =  $arrayDumper->getDumpedContainerData();

