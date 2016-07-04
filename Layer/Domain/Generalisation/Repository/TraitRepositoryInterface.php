<?php

namespace Sfynx\DddBundle\Layer\Domain\Generalisation\Repository;

use Doctrine\ORM\Query;

/**
 * interface Repository
 *
 * @category   Generalisation
 * @package    Repository
 * @subpackage Interface
 */
interface TraitRepositoryInterface
{
    /**
     * @return string
     */
    public function getClassName();

    /**
     * Count all fields existed from the given entity 
     *
     * @param boolean $enabled [0, 1]    
     * 
     * @return string the count of all fields.
     * @access public
     */
    public function count($enabled = null);
    
    /**
     * return query in cache
     *
     * @param Query   $query
     * @param integer $time
     * @param string  $MODE	    [MODE_GET, MODE_PUT , MODE_NORMAL , MODE_REFRESH]	
     * @param boolean $setCacheable
     * @param string  $namespace
     * @param string  $input_hash
     * 
     * @return Query
     * @access public
     */
    public function cacheQuery(Query $query, $time = 3600, $MODE = 3 /* \Doctrine\ORM\Cache::MODE_NORMAL */, $setCacheable = true, $namespace = '', $input_hash = '');

    /**
     * Loads all translations with all translatable
     * fields from the given entity
     * 
     * @link https://github.com/l3pp4rd/DoctrineExtensions/blob/master/doc/translatable.md#entity-domain-object
     *
     * @param Query   $query
     * @param boolean $lazy_loading
     *      
     * @return Query   
     * @access public
     */
    public function setHints(Query $query, $lazy_loading = true);
    
    /**
     * Remove a film entity
     * 
     * @param Film $entity
     */
    public function remove($entity);
    
   /**
     * Find all translations by an entity.
     *
     * @param string $result = {'array', 'object'}
     * @param int    $MaxResults
     * @param string $orderby 
     * 
     * @return array|object
     * @access public
     */
    public function findAllByEntity($result = "object", $MaxResults = null, $orderby = '');
    
    /**
     * Loads all translations with all translatable fields from the given entity
     *
     * @param Query   $query
     * @param string  $result = {'array', 'object'}
     * 
     * @return array|object of result query
     * @access public
     */
    public function findByQuery(Query $query, $result = "array");
}
