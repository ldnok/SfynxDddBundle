<?php

namespace Sfynx\DddBundle\Layer\Presentation\Request\Generalisation;

/**
 * Class AbstractDeleteRequest
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Presentation
 * @subpackage Generalisation
 * @abstract
 */
abstract class AbstractDeleteRequest extends AbstractRequest
{
    protected $defaults = [
        'revision' => ''
    ];

    protected $required = ['entityId'];

    protected $allowedTypes = [
        'entityId' => array('string'),
        'revision' => array('string')
    ];

    /**
     * {@inheritdoc}
     */
    protected function setOptions()
    {
        $this->options = [];
        //get url's params
        $entityIds = $this->request->get('entityId');
        if ($entityIds !== null) {
            $this->options['entityId'] = $entityIds;
        }
        //optional (only for couchdb)
        $revision = $this->request->get('revision');
        if ($revision !== null) {
            $this->options['revision'] = $revision;
        }
    }
}
