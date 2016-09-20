<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\Orm;

use Sfynx\DddBundle\Layer\Infrastructure\Exception\PersistenceException;
use Doctrine\ORM\Query;

/**
 * Trait Repository
 *
 * @category   Generalisation
 * @package    Trait
 * @subpackage Repository
 * @abstract
 */
trait TraitRepository
{
    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->getEntityName();
    }

    /**
     * Count all fields existed from the given entity
     *
     * @param boolean $enabled [0, 1]
     *
     * @return string the count of all fields.
     * @access public
     */
    public function count($enabled = null)
    {
        if (!is_null($enabled)) {
            return $this->_em
            ->createQuery("SELECT COUNT(c) FROM {$this->_entityName} c WHERE c.enabled = '{$enabled}' and c.tenantId = '{$_SERVER['HTTP_X_TENANT_ID']}'")
            ->getSingleScalarResult();
        } else {
            return $this->_em->createQuery("SELECT COUNT(c) FROM {$this->_entityName} c")->getSingleScalarResult();
        }
    }

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
     * @throws  PersistenceException
     */
    public function cacheQuery(Query $query, $time = 3600, $MODE = 3 /* \Doctrine\ORM\Cache::MODE_NORMAL */, $setCacheable = true, $namespace = '', $input_hash = '')
    {
        if (!$query) {
            throw new PersistenceException('Invalide query instance');
        }
        // create single file from all input
        if (empty($input_hash)) {
            $input_hash = $namespace . sha1(serialize($query->getParameters()) . $query->getSQL());
        }
        $query->useResultCache(true, $time, (string) $input_hash);
        $query->useQueryCache(true);
        if (method_exists($query, 'setCacheMode')) {
            $query->setCacheMode($MODE);
        }
        if (method_exists($query, 'setCacheable')) {
            $query->setCacheable($setCacheable);
        }

        return $query;
    }

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
    public function setHints(Query $query, $lazy_loading = true)
    {
        // BE CARFULL ::: Strange Issue with Query Hint and APC
        $query->setHint(
            Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        ); // if you use memcache or apc. You should set locale and other options like fallbacks to query through hints. Otherwise the query will be cached with a first used locale
        if (!$lazy_loading) {
            // to avoid lazy-loading.
            $query->setHint(Query::HINT_FORCE_PARTIAL_LOAD, true);
        }
        $query->setHint(Query::HINT_REFRESH, true);

        return $query;
    }

    /**
     * Remove a film entity
     *
     * @param Film $entity
     */
    public function remove($entity)
    {
        $this->_em->remove($entity);
        $this->_em->flush();
    }

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
    public function findAllByEntity($result = "object", $MaxResults = null, $orderby = '')
    {
        $qb = $this->_em->createQueryBuilder()
        ->select('a')
        ->from($this->_entityName, 'a');

        if (!empty($orderby)) {
            $qb->orderBy("a.$orderby", 'ASC');
        }

        $query = $qb->getQuery();

        if (!is_null($MaxResults)) {
            $query->setMaxResults($MaxResults);
        }

        return $this->findByQuery($query, $result);
    }

    /**
     * Loads all translations with all translatable fields from the given entity
     *
     * @param Query   $query
     * @param string  $result = {'array', 'object'}
     *
     * @return array|object of result query
     * @access public
     * @throws PersistenceException
     */
    public function findByQuery(Query $query, $result = "array")
    {
        if (!$query) {
            throw new PersistenceException(sprintf(
                    'Failed to find Tree by id:[%s]',
                    $id
            ));
        }
        if ($result == 'array') {
            $entities = $query->getArrayResult();
        } elseif ($result == 'object') {
            $entities = $query->getResult();
        } else {
            throw new \InvalidArgumentException("We haven't set the good option value : array or object !");
        }

        return $entities;
    }

    /**
     * way to iterate over a large result set with "yield" php function
     *
     * <code>
     *  $q = $this->_em->createQuery('SELECT e FROM AppBundle:EntityTwo e');
     *  $entityOne->setEntityTwo($this->yieldByQuery($q));
     * </code>
     *
     * @param Query   $query
     *
     * @return iterator
     * @access public
     */
    public function yieldByQuery(Query $query)
    {
        $iterableResult = $query->iterate();
        foreach ($iterableResult as $row) {
            yield $row[0];

            // detach from Doctrine, so that it can be Garbage-Collected immediately
            $this->_em->detach($row[0]);
        }
    }
}
