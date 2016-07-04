<?php

namespace Sfynx\DddBundle\Layer\Domain\Generalisation\Observer;

interface ObservableInterface
{
    public function addObserver(ObserverInterface $observer);
    public function setChanged();
    public function notifyObservers();
}
