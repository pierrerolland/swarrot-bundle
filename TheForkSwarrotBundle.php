<?php

namespace TheFork\SwarrotBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use TheFork\SwarrotBundle\DependencyInjection\Compiler\EatersPass;

class TheForkSwarrotBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new EatersPass());
    }
}
