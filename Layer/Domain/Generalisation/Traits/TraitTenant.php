<?php

namespace Sfynx\DddBundle\Layer\Domain\Generalisation\Traits;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ODM\CouchDB\Mapping\Annotations as CouchDB;
use JMS\Serializer\Annotation\Since;

trait TraitTenant
{
    /**
     * @Since("1")
     * @ORM\Column(type="string")
     * @ODM\Field(type="string")
     * @CouchDB\Field(type="string")
     */
    protected $tenantId;

    /**
     * @return string
     */
    public function getTenantId()
    {
        return $this->tenantId;
    }

    /**
     * @param string $tenantId
     */
    public function setTenantId($tenantId)
    {
        $this->tenantId = $tenantId;
        return $this;
    }
}