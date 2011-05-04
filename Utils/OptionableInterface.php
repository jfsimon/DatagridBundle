<?php

namespace BeSimple\DatagridBundle\Utils;

interface OptionableInterface
{
    /**
     * @return array
     */
    public function getOptions();

    /**
     * @param string $name
     * @return mixed
     */
    public function getOption($name);

    /**
     * @param string $name
     * @return boolean
     */
    public function hasOption($name);
}
