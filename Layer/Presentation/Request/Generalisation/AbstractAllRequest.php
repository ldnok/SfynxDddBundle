<?php

namespace Sfynx\DddBundle\Layer\Presentation\Request\Generalisation;

/**
 * Class AbstractAllRequest
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Presentation
 * @subpackage Generalisation
 * @abstract
 */
abstract class AbstractAllRequest extends AbstractRequest
{
    protected $defaults = [
        'start' => '0',
        'count' => '100',
    ];

    protected $required = [];

    protected $allowedTypes = [
        'start' => array('string'),
        'count' => array('string'),
    ];

    /**
     * {@inheritdoc}
     */
    protected function setOptions()
    {
        $this->options = [];
        //get url's params
        if ($this->request->get('start') != null) {
            $this->options['start'] = $this->request->get('start');
        }
        if ($this->request->get('count') != null) {
            $this->options['count'] = $this->request->get('count');
        }
    }
}
