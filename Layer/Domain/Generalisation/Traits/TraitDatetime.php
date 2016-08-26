<?php
namespace Sfynx\DddBundle\Layer\Domain\Generalisation\Traits;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * abstract class for time attributs.
 * 
 * @category   Generalisation
 * @package    Trait
 * @subpackage Entity
 * @abstract
 */
trait TraitDatetime
{
    /**
     * @var Datetime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;
    
    /**
     * @var DateTime $updatedAt
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedAt;
    
    /**
     * @var DateTime $publishedAt
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    protected $publishedAt;
    
    /**
     * @var DateTime $archiveAt
     *
     * @ORM\Column(name="archive_at", type="datetime", nullable=true)
     */
    protected $archiveAt;
    
     /**
      * @ORM\PrePersist()
      */
     public function setCreatedValue()
     {
         // we create the Created_at value
        if (!$this->getCreatedAt()) {
            $this->setCreatedAt(new DateTime());
        }
        // we modify the Updated_at value
        if (!$this->getUpdatedAt()) {
            $this->setUpdatedAt(new DateTime());
        }
     }
    
     /**
      * @ORM\PreUpdate()
      */
     public function setUpdatedValue()
     {
         $this->setUpdatedAt(new DateTime());
     }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setArchiveAt($archiveAt)
    {
        $this->archiveAt = $archiveAt;
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getArchiveAt()
    {
        return $this->archiveAt;
    }
}
