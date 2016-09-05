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
        if(!array_key_exists($key,$this->process)) {
            throw new \Exception("Key ".$key." do not exists in process list");
        }
        foreach ($this->process[$key] as $process) {
            $process->update($object);
        }
    }
}
