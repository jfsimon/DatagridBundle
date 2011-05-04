<?php

namespace BeSimple\DatagridBundle\Datagrid\Cell;

class ActionsCell extends Cell
{
    /**
     * @var array
     */
    protected $actions;

    public function __toString()
    {
        return '';
    }

    /**
     * @return array
     */
    public function getActions()
    {
        $actions = array();

        foreach ($this->actions as $index => $value) {
            if (is_string($index)) {
                $name = $index;
                $label = $value;
            } else {
                $name = $value;
                $label = sprintf('row.action.%s', $value);
            }

            $actions[$name] = array('label' => $label, 'uri' => $this->getActionUri($name));
        }

        return $actions;
    }

    /**
     * @param array $actions
     * @return void
     */
    public function setActions($actions)
    {
        $this->actions = $actions;
    }

    protected function getActionUri($name)
    {
        $this->ensureRowObject();

        // todo: get the action uri
    }
}
