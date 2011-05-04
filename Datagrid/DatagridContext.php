<?php

namespace BeSimple\DatagridBundle\Datagrid;

use Symfony\Component\HttpFoundation\Session;

class DatagridContext
{
    /**
     * @var \Symfony\Component\HttpFoundation\Session
     */
    protected $session;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var array
     */
    protected $persist;

    /**
     * @var array
     */
    protected $page;

    /**
     * @var array
     */
    protected $sort;

    /**
     * @var array
     */
    protected $filters;

    /**
     * @param \Symfony\Component\HttpFoundation\Session $session
     * @param string $id
     * @param array $persist
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
        $this->id      = null;
        $this->persist = array('page' => false, 'sort' => false, 'filters' => false);
        $this->page    = array('index' => 1, 'length' => null);
        $this->sort    = array('field' => null, 'order' => 'asc');
        $this->filters = array();

        $this->retrieveState();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getPersist()
    {
        return $this->persist;
    }

    /**
     * @param array $persist
     * @return void
     */
    public function setPersist($persist)
    {
        $this->persist = array_merge($this->persist, $persist);
    }

    /**
     * @param string $page
     * @param int $defaultLength
     * @return void
     */
    public function paginate($page, $defaultLength)
    {
        $parts  = explode('|', $page);
        $index  = (int) $parts[0] ?: 1;
        $length = isset($parts[1]) ? (int) $parts[1] : $defaultLength;

        $this->page = array('index' => $index, 'length' => $length);

        $this->persistState('page');
    }

    /**
     * @param string $sort
     * @return void
     */
    public function sort($sort)
    {
        $sort = str_replace('|', '.', $sort);

        if (substr($sort, 0, 1) === '-') {
            $this->sort = array('field' => substr($sort, 1), 'order' => 'desc');
        } else {
            $this->sort = array('field' => $sort, 'order' => $asc);
        }

        $this->persistState('sort');
    }

    /**
     * @return int
     */
    public function getPageIndex()
    {
        return $this->page['index'];
    }

    /**
     * @return int
     */
    public function getPageLength()
    {
        return $this->page['length'];
    }

    /**
     * @return string
     */
    public function getSortField()
    {
        return $this->sort['field'];
    }

    /**
     * @return string
     */
    public function getSortOrder()
    {
        return $this->sort['order'];
    }

    /**
     * @return void
     */
    protected function retrieveState()
    {
        foreach (array('page', 'sort', 'filters') as $part) {
            if ($this->persist[$part]) {
                $this->$part = $this->session->get(sprintf('besimple_datagrid.%s.%s', $this->id, $part));
            }
        }
    }

    /**
     * @param string $part
     * @return void
     */
    protected function persistState($part)
    {
        if ($this->persist[$part]) {
            $this->session->set(sprintf('besimple_datagrid.%s.%s', $this->id, $part), $this->$part);
        }
    }
}
