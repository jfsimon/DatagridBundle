<?php

namespace BeSimple\DatagridBundle\Twig;

class DatagridExtension extends \Twig_Extension
{
    const DEFAULT_THEME = 'default';

    public function getFunctions()
    {
        return array(
            'datagrid' => new \Twig_Function_Method($this, 'renderDatagrid', array('is_safe' => array('html'))),
            'datagrid_rows' => new \Twig_Function_Method($this, 'renderRows', array('is_safe' => array('html'))),
            'datagrid_row' => new \Twig_Function_Method($this, 'renderRow', array('is_safe' => array('html'))),
            'datagrid_pager' => new \Twig_Function_Method($this, 'renderPager', array('is_safe' => array('html'))),
            'datagrid_cell' => new \Twig_Function_Method($this, 'renderCell', array('is_safe' => array('html'))),
        );
    }

    public function renderDatagrid(Datagrid $datagrid, $theme = self::DEFAULT_THEME)
    {
        return $this->render($theme, 'datagrid', array('datagrid' => $datagrid));
    }

    public function renderRows(array $rows, $theme = self::DEFAULT_THEME)
    {
        return $this->render($theme, 'rows', array('rows' => $rows));
    }

    public function renderRow(array $row, $theme = self::DEFAULT_THEME)
    {
        return $this->render($theme, 'row', array('row' => $row));
    }

    public function renderPager($pager, $theme = self::DEFAULT_THEME)
    {
        return $this->render($theme, 'pager', array('pager' => $pager));
    }

    public function renderCell(Cell $cell, $theme = self::DEFAULT_THEME)
    {
        return $this->render($theme, $cell->getDecorator(), array('cell' => $cell));
    }

    protected function render($theme, $decorator, array $arguments)
    {
        return $this->getTemplate($theme, $decorator)->renderBlock($decorator, $arguments);
    }

    protected function getTemplate($theme, $decorator)
    {
        // todo: return a template
    }
}
