<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\CouchDB\views;

use Doctrine\CouchDB\View\DesignDocument;

abstract class AbstractDesignDocument implements DesignDocument
{
    protected $sEntityDotNamespace;

    abstract public function initEntityDotNamespace();

    /**
     * Get design doc code
     *
     * Return the view (or general design doc) code, which should be
     * committed to the database, which should be structured like:
     *
     * <code>
     *  array(
     *    "views" => array(
     *      "name" => array(
     *          "map"     => "code",
     *          ["reduce" => "code"],
     *      ),
     *      ...
     *    )
     *  )
     * </code>
     */
    public function getData()
    {
        return array(
            'language' => 'javascript',
            'views' => array(
                'all_rev' => array(
                    'map' => 'function(doc) {
                        emit(null, doc._rev);
                    }'
                ),
                'all' => array(
                    'map' => sprintf('function(doc) {
                        if(%s == doc.type) {
                            emit(null, doc);
                        }
                    }', $this->sEntityDotNamespace),
                    'reduce' => '_count'
                ),
                "by_id" => array(
                    "map" => sprintf('function(doc) {
                        if(%s == doc.type) {
                          emit(doc._id, doc);
                        }
                     }', $this->sEntityDotNamespace)
                )
            ),
        );
    }
}
