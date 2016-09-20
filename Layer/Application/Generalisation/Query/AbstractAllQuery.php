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
     * @param $start
     * @param $count
     * @param $orderBy
     * @param $isAsc
     */
    public function __construct($start = null, $count = null)
    {
        $this->start = $start;
        $this->count = $count;
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
