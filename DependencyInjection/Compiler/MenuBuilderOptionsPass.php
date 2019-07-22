<?php
namespace Millwright\MenuBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\Config\Definition\Processor;

use Millwright\Util\DependencyInjection\ContainerUtil;

use Millwright\MenuBundle\DependencyInjection\MenuConfiguration;

class MenuBuilderOptionsPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $config = ContainerUtil::collectConfiguration(
            'millwright_menu.menu_options',
            $container
        );

        $container->getDefinition('millwright_menu.helper')
            ->replaceArgument(2, $config['renderers']);

        unset($config['renderers']);

        $container->getDefinition('millwright_menu.option.builder')
            ->addMethodCall('setDefaults', array($config));
    }
}
