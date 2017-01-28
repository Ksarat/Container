<?php

namespace ConfigContainerDumper;

/**
 * Class XmlConfigContainerDumper
 * @package ConfigContainerDumper
 */
class XmlConfigContainerDumper extends AbstractConfigContainerDumper implements IConfigFileDumper
{

    /**
     * @return mixed
     */
    public function getDumpedContainerData()
    {
        $containerData = $this->getContainerData();
        $parsedXml = $this->getXmlFormArray($containerData);

        return $parsedXml;
    }

    /**
     *
     */
    public function downloadDumpAsFile()
    {
        $parsedXml = $this->getDumpedContainerData();

        header('Content-type: text/xml');
        header('Content-Disposition: attachment; filename="config.xml"');

        echo $parsedXml;
        exit;
    }

    /**
     * @param array $containerData
     * @return mixed
     */
    private function getXmlFormArray(array $containerData)
    {
        $xml = new \SimpleXMLElement('<config/>');

        $this->arrayToXml($containerData, $xml);

        return $xml->asXML();
    }

    /**
     * @param $data
     * @param $xmlData
     */
    private function arrayToXml($data, &$xmlData)
    {
        foreach ($data as $key => $value) {
            if (is_numeric($key)) {
                $key = 'item' . $key;
            }
            if (is_array($value)) {
                $subNode = $xmlData->addChild($key);
                $this->arrayToXml($value, $subNode);
            } else {
                $xmlData->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }


}