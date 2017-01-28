<?php

namespace ConfigContainerDumper;

/**
 * Class IniConfigContainerDumper
 * @package ConfigContainerDumper
 */
class IniConfigContainerDumper extends AbstractConfigContainerDumper implements IConfigFileDumper
{

    /**
     * @return string
     */
    public function getDumpedContainerData()
    {
        $containerData = $this->getContainerData();

        $preparedIni = $this->getIniFormArray($containerData);

        return $preparedIni;
    }

    /**
     * @param array $containerData
     * @param array $upperLevel
     * @return string
     */
    private function getIniFormArray(array $containerData, array $upperLevel = [])
    {
        $preparedIni = '';

        foreach ($containerData as $key => $value) {
            if (is_array($value)) {
                $section = array_merge((array)$upperLevel, (array)$key);
                $preparedIni .= sprintf('[%1$s]%2$s', implode('.', $section), PHP_EOL);
                $preparedIni .= $this->getIniFormArray($value, $section);
            } else {
                $preparedIni .= sprintf('"%1$s"="%2$s"%3$s', $key, $value, PHP_EOL);
            }
        }
        return $preparedIni;
    }

    /**
     *
     */
    public function downloadDumpAsFile()
    {
        $preparedIni = $this->getDumpedContainerData();

        header('Content-type: text/plain');
        header('Content-disposition: attachment; filename=config.ini');

        echo $preparedIni;
        exit;
    }

}