<?php

namespace BeSimple\DatagridBundle\Datagrid\Column;

use BeSimple\DatagridBundle\Datagrid\DatagridContext;
use BeSimple\DatagridBundle\Datagrid\DatagridRouter;

class FieldColumn implements FieldColumnInterface
{
    protected $context;
    protected $router;
    protected $field;

    public function __construct(DatagridContext $context, DatagridRouter $router, Field $field)
    {
        $this->context = $context;
        $this->router  = $router;
        $this->field   = $field;
    }

    public function getField()
    {
        return $this->field;
    }

    public function getHeaderCell()
    {
        return new SortCell($this->field, $this->getSortUrl(), $this->getSortOrder());
    }

    public function getBodyCell(Row $row)
    {
        return new ValueCell($this->field, $row, $this->getSortOrder());
    }

    protected function getSortOrder()
    {
        return $this->field->getName() === $this->context->getSortField()
            ? $this->context->getSortOrder()
            : null;
    }

    protected function getSortUrl()
    {
        return $this->router->generate(
            $this->context->getPageIndex(),
            $this->context->getPageLength(),
            $this->context->getSortField(),
            $this->context->getSortOrder() === 'asc' ? 'desc' : 'asc'
        );
    }
}
