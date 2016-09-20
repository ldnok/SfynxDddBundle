<?php

namespace Sfynx\DddBundle\Layer\Domain\Generalisation\Entity;

/**
 * FilmRepository interface
 * 
 */
interface TraitDatetimeInterface
{
    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt);
    
    /**
     * Get created_at
     *
     * @return datetime
     */
    public function getCreatedAt();
    
    /**
     * Set updated_at
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt);
    
    /**
     * Get updated_at
     *
     * @return datetime
     */
    public function getUpdatedAt();
    
    /**
     * Set published_at
     *
     * @param date $publishedAt
     */
    public function setPublishedAt($publishedAt);
    
    /**
     * Get published_at
     *
     * @return date
     */
    public function getPublishedAt();
    
    /**
     * Set archive_at
     *
     * @param datetime $archiveAt
     */
    public function setArchiveAt($archiveAt);
    
    /**
     * Get archive_at
     *
     * @return datetime
     */
    public function getArchiveAt();
}
