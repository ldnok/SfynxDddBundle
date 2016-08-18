<?php

namespace Sfynx\DddBundle\Layer\Domain\ValueObject;

use Sfynx\DddBundle\Layer\Domain\ValueObject\Generalisation\ValueObjectInterface;
use Sfynx\DddBundle\Layer\Domain\ValueObject\Generalisation\TraitValueObjectEquals;
use Sfynx\DddBundle\Layer\Infrastructure\Exception\DomainException;
use Rhumsaa\Uuid\Uuid as BaseUuid;
use JMS\Serializer\Annotation\Since;

class IdVO implements ValueObjectInterface
{
    use TraitValueObjectEquals;

    /**
     * @Since("1")
     * @var string
     */
    protected $id;

    /**
     * Returns a object given a PHP native string as parameter.
     *
     * @param  string $value
     * @return StringLiteral
     */
    public static function fromNative()
    {
        $value = func_get_arg(0);

        return new static($value);
    }

    /**
     * Generate a new UUID string
     *
     * @return string
     */
    public static function generateAsString()
    {
        $uuid       = new static();
        $uuidString = $uuid->toNative();

        return $uuidString;
    }

    /**
     * Returns the value of the string
     *
     * @return string
     */
    public function toNative()
    {
        return $this->id;
    }

    /**
     * @param  string $id
     * @throws DomainException
     */
    public function __construct($id = null)
    {
        $uuid_str = BaseUuid::uuid4();

        if (null !== $id) {
            $pattern = '/'.BaseUuid::VALID_PATTERN.'/';

            if (! \preg_match($pattern, $id)) {
                throw new DomainException($id, array('UUID string'));
            }

            $uuid_str = $id;
        }

        $this->id = \strval($uuid_str);
    }


    /**
     * @param $id
     */
    protected function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return string
     */
    public function id()
    {
        return $this->id;
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
}
