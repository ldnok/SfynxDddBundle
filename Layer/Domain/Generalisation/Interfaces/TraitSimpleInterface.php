<?php

namespace Sfynx\DddBundle\Layer\Domain\Generalisation\Interfaces;

/**
 * FilmRepository interface
 *
 */
interface TraitSimpleInterface
{
    /**
     * Set archived
     *
     * @param boolean $enabled
     */
    public function setArchived($archived);

    /**
     * Get archived
     *
     * @return boolean
     */
    public function getArchived();
}
