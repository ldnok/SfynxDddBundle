<?php

namespace Sfynx\DddBundle\Layer\Presentation\Request\Generalisation\Request;

/**
 * Default Abstract of the Request strategy .
 *
 * @category   Strategy
 * @package    Presentation
 * @subpackage Request
 */
abstract class AbstractRequest implements RequestInterface {
    /** @var cookies */
    public $cookies = null;
    /** @var query */
    public $query = null;
    /** @var header */
    public $headers = null;
    /** @var attributes */
    public $attributes = null;
    /** @var files */
    public $files = null;
    /** @var server */
    public $server = null;
}
