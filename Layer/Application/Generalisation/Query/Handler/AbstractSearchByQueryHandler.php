<?php

namespace Sfynx\DddBundle\Layer\Application\Generalisation\Query\Handler;

use Sfynx\DddBundle\Layer\Application\Generalisation\Interfaces\QueryHandlerInterface;
use Sfynx\DddBundle\Layer\Application\Generalisation\Interfaces\QueryInterface;
use Sfynx\DddBundle\Layer\Domain\Service\Generalisation\Manager\ManagerInterface;

/**
 * Class AbstractAllQueryHandler
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Application
 * @subpackage Query
 * @abstract
 */
class AbstractSearchByQueryHandler implements QueryHandlerInterface
{
    /**
     * @var ManagerInterface
     */
    protected $manager;

    /**
     * @param ManagerInterface $manager
     */
    public function __construct(ManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param QueryInterface $query
     * @return mixed
     */
    public function process(QueryInterface $query)
    {

        $entities = $this->manager->searchBy(
            $query->getCriterias(),
            $query->getStart(),
            $query->getCount()
        );

        return $entities;
    }
}
