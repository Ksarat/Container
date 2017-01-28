<?php

namespace ConfigContainerDumper;

/**
 * Class JsonConfigContainerDumper
 * @package ConfigContainerDumper
 */
class JsonConfigContainerDumper extends AbstractConfigContainerDumper implements IConfigFileDumper
{
    /**
     * @return string
     */
    public function getDumpedContainerData()
    {
        $containerData = $this->getContainerData();

        $parsedJson = $this->getJsonFormArray($containerData);

        return $parsedJson;

    }

    /**
     * @param array $containerData
     * @return string
     */
    private function getJsonFormArray(array $containerData)
    {
        $parsedJson = json_encode($containerData);
        return $parsedJson;
    }

    /**
     *
     */
    public function downloadDumpAsFile()
    {
        $parsedJson = $this->getDumpedContainerData();

        header('Content-type: application/json');
        header('Content-disposition: attachment; filename=config.json');

        echo $parsedJson;
        exit;

    }

}