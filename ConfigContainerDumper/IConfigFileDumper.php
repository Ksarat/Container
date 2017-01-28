<?php

namespace ConfigContainerDumper;


/**
 * Interface IConfigFileDumper
 * @package ConfigContainerDumper
 */
interface IConfigFileDumper
{

    /**
     *
     * downloadDumpAsFile() function implemented in all realization
     * relying on the fact that it should not be large file
     * (cuz load large file in object would not be very good)
     * in other way better use way like create file and part by part
     * writing it in file and then return it to client
     *
     * @return mixed
     */
    public function downloadDumpAsFile();

}