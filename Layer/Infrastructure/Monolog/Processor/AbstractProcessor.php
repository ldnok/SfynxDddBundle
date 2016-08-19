<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Monolog\Processor;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use FOS\UserBundle\Model\UserInterface;

class AbstractProcessor
{
    /**
     * @var TokenStorageInterface
     */
    protected $token_storage;

    /**
     * Constructor.
     *
     * @param TokenStorageInterface $container The service container
     */
    public function __construct(TokenStorageInterface $token_storage)
    {
        $this->token_storage = $token_storage;
    }

    /**
     * Return if yes or no the user is anonymous token.
     *
     * @return boolean
     * @access public
     */
    public function isAnonymousToken()
    {
        return (
            ($this->getToken() instanceof AnonymousToken)
            ||
            ($this->getToken() === null)
        );
    }

    /**
     * Return if yes or no the user is UsernamePassword token.
     *
     * @return boolean
     * @access public
     */
    public function isUsernamePasswordToken()
    {
        return $this->getToken() instanceof UsernamePasswordToken;
    }

    /**
     * Return the connected user entity.
     *
     * @return UserInterface
     * @access public
     */
    public function getUser()
    {
        return $this->getToken()->getUser();
    }

    /**
     * Return the token object.
     *
     * @return UsernamePasswordToken
     * @access public
     */
    public function getToken()
    {
        return  $this->token_storage->getToken();
    }
}
