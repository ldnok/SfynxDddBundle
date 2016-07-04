<?php

namespace Sfynx\DddBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Sfynx\DddBundle\DependencyInjection\SfynxDddBundleExtension;

class SfynxDddBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new SfynxDddBundleExtension();
    }

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
    }
}