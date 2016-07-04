<?php

namespace Sfynx\DddBundle\Layer\Presentation\Request\Generalisation;

/**
 * Class AbstractGetByIdsRequest
 *
 * @category   Sfynx\DddBundle\Layer
 * @package    Presentation
 * @subpackage Generalisation
 * @abstract
 */
abstract class AbstractGetByIdsRequest extends AbstractRequest
{
    protected $required = ['entityIds'];
    protected $allowedTypes = ['entityIds' => ['string']];

    /**
     * {@inheritdoc}
     */
    protected function setOptions()
    {
        $this->options = [];
        //get url's params
        $entityIds = $this->request->get('entityIds');
        if ($entityIds !== null) {
            $this->options['entityIds'] = $entityIds;
        }
    }
}
