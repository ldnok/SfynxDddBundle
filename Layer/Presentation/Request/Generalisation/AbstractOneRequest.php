<?php

namespace Sfynx\DddBundle\Layer\Presentation\Request\Generalisation;

/**
 * Class AbstractOneRequest
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Presentation
 * @subpackage Generalisation
 * @abstract
 */
abstract class AbstractOneRequest extends AbstractRequest
{
    protected $required = ['entityId'];
    protected $allowedTypes = ['entityId' => ['string']];

    /**
     * {@inheritdoc}
     */
    protected function setOptions()
    {
        $this->options = [];
        //get url's params
        $entityId = $this->request->get('entityId');
        if ($entityId !== null) {
            $this->options['entityId'] = $entityId;
        }
    }
}
