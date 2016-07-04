<?php

namespace Sfynx\DddBundle\Layer\Domain\Workflow\Generalisation;

use Sfynx\DddBundle\Layer\Application\Generalisation\Interfaces\CommandInterface;
use Sfynx\DddBundle\Layer\Domain\Generalisation\Observer\ObservableInterface;
use Sfynx\DddBundle\Layer\Domain\Generalisation\Observer\ObserverInterface;

abstract class AbstractWFHandler implements WorkflowHandlerInterface, ObservableInterface
{
    protected $command;

    protected $observers;

    protected $changed;

    public $data;

    public function __construct() {
        $this->observers = [];
        $this->changed = false;
        $this->data = new \stdClass();
    }

    public function process(CommandInterface $command)
    {
        $this->initCommand($command);

        // notify all observers
        $this->setChanged();
        $this->notifyObservers();
    }

    /* TODO change array with SqlQueue and test performance */
    public function addObserver(ObserverInterface $observer)
    {
        $this->observers[] = $observer;
    }

    public function setChanged()
    {
        $this->changed = true;
    }

    public function hasChanged()
    {
        return $this->changed;
    }

    public function notifyObservers()
    {
        if ($this->hasChanged()) {
            foreach ($this->observers as $observer) {
                $observer->update($this);
            }
            $this->clearChanged();
        }
    }

    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param CommandInterface $command
     */
    protected function initCommand(CommandInterface $command)
    {
        $this->command = $command;
    }

    /**
     *
     */
    protected function clearChanged()
    {
        $this->changed = false;
    }
}
