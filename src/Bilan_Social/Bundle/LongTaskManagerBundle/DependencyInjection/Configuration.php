<?php
namespace Bilan_Social\Bundle\LongTaskManagerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('long_task_manager');

        $rootNode
            ->children()
                ->scalarNode('host')->end()
                ->scalarNode('base_url')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
?>