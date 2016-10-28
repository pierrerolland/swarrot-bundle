<?php

namespace TheFork\SwarrotBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class EatersPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('thefork_swarrot.processor')) {
            return;
        }

        $definition = $container->findDefinition('thefork_swarrot.processor');
        $taggedServices = $container->findTaggedServiceIds('thefork_swarrot.eater');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addEater', [new Reference($id)]);
        }
    }
}
