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
class SalaryVO implements ValueObjectInterface
{
    use TraitValueObjectEquals;

    /**
     * @Since("2")
     * @ORM\Column(type="float")
     * @ODM\Field(type="float")
     *
     * @CouchDB\Field(type="float")
     */
    protected $value;

    /**
     * @Since("2")
     * @ORM\Column(type="string", length=3)
     * @ODM\Field(type="string")
     *
     * @CouchDB\Field(type="string")
     */
    protected $currency;

    /**
     * Returns a object given a PHP native string as parameter.
     *
     * @param  mixed $value
     */
    public static function fromNative()
    {
        $args = func_get_args();

        return new static($args[0], $args[1]);
    }

    /**
     * @param $value
     * @param $currency
     */
    public function __construct($value, $currency)
    {
        $this->setValue($value);
        $this->setCurrency($currency);
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    protected function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    protected function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf("%s %s", $this->value, $this->currency);
    }
}
