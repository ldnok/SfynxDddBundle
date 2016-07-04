<?php

namespace Sfynx\DddBundle\Layer\Presentation\Request\Generalisation;

/**
 * Class AbstractDeleteManyRequest
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Presentation
 * @subpackage Generalisation
 * @abstract
 */
abstract class AbstractDeleteManyRequest extends AbstractRequest
{
    protected $required = ['entityIds'];
    protected $allowedTypes = ['entityIds' => ['array']];
}
