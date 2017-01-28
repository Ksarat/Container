<?php

namespace ConfigContainerDumper;

/**
 * Class AbstractConfigContainerDumper
 * @package ConfigContainerDumper
 */
 class ArrayConfigContainerDumper extends  AbstractConfigContainerDumper
{

  public function getDumpedContainerData()
  {
      $containerData = $this->getContainerData();

      return $containerData;
  }

}