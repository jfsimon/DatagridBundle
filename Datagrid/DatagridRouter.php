<?php

namespace BeSimple\DatagridBundle\Datagrid;

use Symfony\Component\Routing\Router;

class DatagridRouter
{
    /**
     * @var \Symfony\Component\Routing\Router
     */
    protected $router;

    /**
     * @var string
     */
    protected $route;

    /**
     * @var array
     */
    protected $parameters;

    /**
     * @param \Symfony\Component\Routing\Router $router
     * @param string $route
     * @param array $parameters
     */
    public function __construct(Router $router)
    {
        $this->router     = $router;
        $this->route      = null;
        $this->parameters = array('page' => 'page', 'sort' => 'sort');
    }

    /**
     * @return null|string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param string $route
     * @return void
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param array $actions
     * @return void
     */
    public function setActions(array $actions)
    {
        $this->actions = $actions;
    }

    /**
     * @param int $pageIndex
     * @param int $pageLength
     * @param string $sortField
     * @param string $sortOrder
     * @return string
     */
    public function generate($pageIndex, $pageLength, $sortField, $sortOrder)
    {
        $sortField = str_replace('.', '|', $sortField);

        return $this->router->generate($this->route, array(
             $this->parameters['page'] => sprintf('%s|%s', $pageIndex, $pageLength),
             $this->parameters['sort'] => sprintf('%s%s', $sortOrder === 'asc' ? '' : '-', $sortField),
        ));
    }

    /**
     * @param Action $action
     * @param Row $row
     * @return string
     */
    public function generateAction(Action $action, Row $row)
    {
        return $this->router->generate(
            $action->getRoute(),
            array($action->getParameter() => $row->getValue($action->getParameter()))
        );
    }
}
