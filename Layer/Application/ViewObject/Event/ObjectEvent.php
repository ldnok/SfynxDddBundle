<?php
namespace Sfynx\DddBundle\Layer\Application\ViewObject\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class ObjectEvent
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Application
 * @subpackage ViewObject
 */
class ObjectEvent extends Event
{
    /**
     * @var Object $entity
     */
    private $entity;

    /**
     * @param $entity
     */
    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return object entity
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param Object $entity
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    }
}
