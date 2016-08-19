<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Monolog\Handler;

use Monolog\Handler\SocketHandler as MonologSocketHandler;

class SocketHandler extends MonologSocketHandler
{
    protected function generateDataStream($record)
    {
        unset($record['formatted']);

        return json_encode($record)."\n";
    }
}
