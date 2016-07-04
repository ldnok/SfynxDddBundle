<?php

namespace Sfynx\DddBundle\Layer\Application\Generalisation\Validation\SpecHandler;

use Sfynx\DddBundle\Layer\Infrastructure\Logger\Generalisation\TraitLogger;
use Sfynx\SpecificationBundle\Specification\Generalisation\InterfaceSpecification;
use Sfynx\SpecificationBundle\Specification\Logical\AndSpec;
use Sfynx\SpecificationBundle\Specification\Logical\TrueSpec;
use Sfynx\DddBundle\Layer\Infrastructure\Exception\SpecificationException;

abstract class AbstractCommandSpecHandler
{
    use TraitLogger;

    protected $object = null;

    /**
     * init the object that must satisfy specs
     * it is generally called in service definition
     * @param $object
     */
    public function setObject($object)
    {
        $this->object = new \stdClass();
        $this->object->value = $object;
    }

    /**
     * @param mixed                  $object        the object that must satisfy specs if we want to override it
     * @param InterfaceSpecification $specification if we want to override the initSpecifications methods
     *
     * @return bool
     * @throws \Exception
     */
    public function process($object = null, InterfaceSpecification $specification = null)
    {
        if (null === $object) {
            $object = $this->object;
        }
        if (!$object instanceof \stdClass) {
            throw  SpecificationException::NoStdClassObject();
        }
        if (null === $specification) {
            $specification = $this->initSpecifications();
        }
        if (!$specification instanceof InterfaceSpecification) {
            throw  SpecificationException::BadInterfaceSpecification();
        }
        $specs = new AndSpec(new TrueSpec(), $specification);

        if (!$specs->isSatisfiedBy($object)) {
            $this->logger->error('error in spec handler');
            $this->logger->error($specs->getLogicalExpression());//log the profiler
            $profiler = $specs->getProfiler();
            $this->logger->error($profiler);//log the profiler

            throw SpecificationException::Profiler(serialize($profiler));
        }
        $this->logger->info(var_export($specs->getProfiler(), true));
        return true;
    }

    /**
     * @return InterfaceSpecification
     */
    abstract protected function initSpecifications();
}
