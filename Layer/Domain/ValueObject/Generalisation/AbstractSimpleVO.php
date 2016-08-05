<?php

namespace Sfynx\DddBundle\Layer\Domain\ValueObject\Generalisation;

use JMS\Serializer\Annotation\Since;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Class AbstractSimpleVO
 *
 * @package Sfynx\DddBundle\Layer\Domain\ValueObject\Generalisation
 * @abstract
 */
abstract class AbstractSimpleVO implements ValueObjectInterface
{
    use TraitValueObjectEquals;

    /**
     * @Since("1")
     * @var string $value Value
     */
    protected $value;

    /**
     * @param string $value The value
     */
    public function __construct($value = null)
    {
        $this->setValue($value);
    }

    /**
     * Returns a StringLiteral object given a PHP native string as parameter.
     *
     * @param  mixed $value
     *
     * @return AbstractSimpleVO
     */
    public static function fromNative()
    {
        $value = func_get_arg(0);

        return new static($value);
    }

    /**
     * @return string
     */
    public static function generateAsString()
    {
        $value       = new static();
        $valueString = $value->toNative();

        return $valueString;
    }

    /**
     * @return mixed
     */
    public function toNative()
    {
        return $this->value;
    }

    /**
     * Tells whether the StringLiteral is empty
     *
     * @return bool
     */
    public function isEmpty()
    {
        return \strlen($this->toNative()) == 0;
    }

    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $newValue
     */
    protected function setValue($newValue)
    {
        $this->value = $newValue;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform) {
        return true;
    }

    public function canRequireSQLConversion() {
        return true;
    }
}
