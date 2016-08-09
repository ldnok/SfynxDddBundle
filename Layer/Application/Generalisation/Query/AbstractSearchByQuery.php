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
abstract class AbstractSearchByQuery implements QueryInterface
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
    public function __construct($criterias, $start, $count)
    {
        $this->start = $start;
        $this->count = $count;
        $this->criterias = $criterias;
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


    /**
     * @param mixed $count
     */
    public function getCriterias()
    {
        return $this->criterias;
    }


    /**
     * @param mixed $count
     */
    public function setCriterias($criterias)
    {
        $this->criterias = $criterias;
    }
}
