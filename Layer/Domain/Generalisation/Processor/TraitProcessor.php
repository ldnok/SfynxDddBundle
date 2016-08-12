<?php

namespace Sfynx\DddBundle\Layer\Domain\Generalisation\Processor;

trait TraitProcessor
{
    protected $process = [];

    public function addProcess($key, ProcessInterface $process)
    {
        $this->process[$key][] = $process;
    }

    public function executeProcess($key, $object)
    {
        if(isset($this->process[$key])) {
            foreach ($this->process[$key] as $process) {
                $process->update($object);
            }
        }
    }
}
