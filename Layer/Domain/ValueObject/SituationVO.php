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
class SituationVO implements ValueObjectInterface
{
    use TraitValueObjectEquals;

    /**
     * @Since("1")
     * @ORM\Column(type="SexVO")
     * @ODM\Field(type="SexVO")
     *
     * @CouchDB\Field(type="SexVO")
     */
    protected $sex;

    /**
     * @Since("1")
     * @ORM\Column(type="date")
     * @ODM\Field(type="date")
     *
     * @CouchDB\Field(type="DateTime")
     */
    protected $birthday;

    /**
     * Returns a object given a PHP native string as parameter.
     *
     */
    public static function fromNative()
    {
        $args = func_get_args();

        return new static($args[0], $args[1]);
    }

    /**
     * @param SexVO $sex
     * @param \DateTime $birthday
     */
    public function __construct(SexVO $sex, \DateTime $birthday)
    {
        $this->setSex($sex);
        $this->setBirthday($birthday);
    }

    /**
     * @return SexVO
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param SexVO $sex
     */
    protected function setSex(SexVO $sex)
    {
        $this->sex = $sex;
    }

    /**
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param \DateTime $birthday
     */
    protected function setBirthday(\DateTime $birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s %s', $this->sex, $this->birthday->format('d/m/Y'));
    }
}
