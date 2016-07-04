<?php

namespace Sfynx\DddBundle\Layer\Domain\ValueObject;

use Sfynx\DddBundle\Layer\Domain\ValueObject\Generalisation\ValueObjectInterface;
use Sfynx\DddBundle\Layer\Domain\ValueObject\Generalisation\TraitValueObjectEquals;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\CouchDB\Mapping\Annotations as CouchDB;
use JMS\Serializer\Annotation\Since;

/**
 * @ORM\Embeddable
 * @ODM\EmbeddedDocument
 *
 * @CouchDB\EmbeddedDocument
 */
class ProfilVO implements ValueObjectInterface
{
    use TraitValueObjectEquals;

    /**
     * @Since("1")
     * @ORM\Column(type="EntityNameVO", length=50)
     * @ODM\Field(type="EntityNameVO")
     *
     * @CouchDB\Field(type="EntityNameVO")
     */
    protected $lastname;

    /**
     * @Since("1")
     * @ORM\Column(type="EntityNameVO", length=50)
     * @ODM\Field(type="EntityNameVO")
     *
     * @CouchDB\Field(type="EntityNameVO")
     */
    protected $firstname;

    /**
     * Returns a object given a PHP native string as parameter.
     *
     * @param  string $value
     */
    public static function fromNative()
    {
        $args = func_get_args();

        return new static($args[0], $args[1]);
    }

    /**
     * @param EntityNameVO $lastname
     * @param EntityNameVO $firstname
     */
    public function __construct(EntityNameVO $lastname, EntityNameVO $firstname)
    {
        $this->setLastname($lastname);
        $this->setFirstname($firstname);
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param EntityNameVO $lastname
     */
    protected function setLastname(EntityNameVO $lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @param EntityNameVO $firstname
     */
    protected function setFirstname(EntityNameVO $firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s %s', $this->getLastname()->getValue(), $this->getFirstname()->getValue());
    }
}
