<?php

namespace Sfynx\DddBundle\Layer\Application\Generalisation\Query;

use Sfynx\DddBundle\Layer\Application\Generalisation\Interfaces\QueryInterface;

/**
 * Class AbstractAllQuery.
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Application
 * @subpackage Generalisation
 * @abstract
 */
abstract class AbstractAllQuery implements QueryInterface
{
    /**
     * @var
     */
    protected $start;

    /**
     * @var
     */
    protected $count;

    /**
     * @var
     */
    protected $orderBy;

    /**
     * @var
     */
    protected $isAsc;

    /**
     * @param $start
     * @param $count
     * @param $orderBy
     * @param $isAsc
     */
    public function __construct($start = null, $count = null, $orderBy = null, $isAsc = null)
    {
        $this->start = $start;
        $this->count = $count;
        $this->orderBy = $orderBy;
        $this->isAsc = $isAsc;
    }

    /**
     * @return mixed
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * @param mixed $orderBy
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;
    }

    /**
     * @return mixed
     */
    public function getIsAsc()
    {
        return $this->isAsc;
    }

    /**
     * @param mixed $isAsc
     */
    public function setIsAsc($isAsc)
    {
        $this->isAsc = $isAsc;
    }

    /**
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param mixed $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }
}
