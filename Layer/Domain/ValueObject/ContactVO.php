<?php

namespace Sfynx\DddBundle\Layer\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\CouchDB\Mapping\Annotations as CouchDB;
use Sfynx\DddBundle\Layer\Domain\ValueObject\Generalisation\ValueObjectInterface;
use Sfynx\DddBundle\Layer\Domain\ValueObject\Generalisation\TraitValueObjectEquals;
use JMS\Serializer\Annotation\Since;

/**
 * @ORM\Embeddable
 * @ODM\EmbeddedDocument
 *
 * @CouchDB\EmbeddedDocument
 */
class ContactVO implements ValueObjectInterface
{
    use TraitValueObjectEquals;

    /**
     * @Since("1")
     * @ORM\Column(type="PhoneNumberVO")
     * @ODM\Field(type="PhoneNumberVO")
     *
     * @CouchDB\Field(type="PhoneNumberVO")
     */
    private $phoneNumber1;

    /**
     * @Since("1")
     * @ORM\Column(type="PhoneNumberVO")
     * @ODM\Field(type="PhoneNumberVO")
     *
     * @CouchDB\Field(type="PhoneNumberVO")
     */
    private $phoneNumber2;

    /**
     * @Since("1")
     * @ORM\Column(type="EmailVO")
     * @ODM\Field(type="EmailVO")
     *
     * @CouchDB\Field(type="EmailVO")
     */
    private $email;

    /**
     * Returns a object given a PHP native string as parameter.
     *
     */
    public static function fromNative()
    {
        $args = func_get_args();

        return new static($args[0], $args[1], $args[2]);
    }

    /**
     * @param EmailVO $email
     * @param PhoneNumberVO $phoneNumber1
     * @param PhoneNumberVO|null $phoneNumber2
     */
    public function __construct(EmailVO $email, PhoneNumberVO $phoneNumber1, PhoneNumberVO $phoneNumber2 = null)
    {
        $this->setEmail($email);
        $this->setPhoneNumber1($phoneNumber1);
        $this->setPhoneNumber2($phoneNumber2);
    }

    /**
     * @return PhoneNumberVO
     */
    public function getPhoneNumber1()
    {
        return $this->phoneNumber1;
    }

    /**
     * @param PhoneNumberVO $phoneNumber1
     */
    protected function setPhoneNumber1(PhoneNumberVO $phoneNumber1)
    {
        $this->phoneNumber1 = $phoneNumber1;
    }

    /**
     * @return PhoneNumberVO
     */
    public function getPhoneNumber2()
    {
        return $this->phoneNumber2;
    }

    /**
     * @param PhoneNumberVO $phoneNumber2
     */
    protected function setPhoneNumber2(PhoneNumberVO $phoneNumber2 = null)
    {
        $this->phoneNumber2 = $phoneNumber2;
    }

    /**
     * @return EmailVO
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    protected function setEmail(EmailVO $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s %s %s',$this->email, $this->phoneNumber1, $this->phoneNumber2);
    }
}
