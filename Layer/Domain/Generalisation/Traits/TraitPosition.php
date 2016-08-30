<?php
namespace Sfynx\DddBundle\Layer\Domain\Generalisation\Traits;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * abstract class for position attributs.
 * 
 * @category   Generalisation
 * @package    Trait
 * @subpackage Entity
 * @abstract
 */
trait TraitPosition
{
    /**
     * @ORM\Column(name="position", type="integer",  nullable=true)
     */
    protected $position;

    /**
     * @param $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }
}
