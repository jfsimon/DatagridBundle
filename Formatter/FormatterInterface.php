<?php

namespace BeSimple\DatagridBundle\Formatter;

use BeSimple\DatagridBundle\Utils\OptionableInterface;

interface FormatterInterface extends OptionableInterface
{
    /**
     * Return associated type names (from global to specialized).
     *
     * @return array
     */
    public function getTypes();

    /**
     * Return initial value.
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Return formatter factory.
     *
     * @return FormatterFactory
     */
    public function getFactory();

    /**
     * Format value for display.
     *
     * @throws FormatterException
     * @return string
     */
    public function formatDisplay();

    /**
     * Return the form field for this value.
     *
     * @throws FormatterException
     * @return \Symfony\Component\Form\Field
     */
    public function getFormField($key);
}
