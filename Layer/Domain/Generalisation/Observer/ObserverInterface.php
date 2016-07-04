<?php

namespace Sfynx\DddBundle\Layer\Domain\Generalisation\Observer;

interface ObserverInterface
{
    public function update(ObservableInterface $observable);
}
