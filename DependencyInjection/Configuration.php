<?php

namespace SaadTazi\Bundle\OEmbedBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('saad_tazi_o_embed');

        $rootNode
            ->children()
                ->arrayNode('endpoints')
                    //->ignoreExtraKeys(true)->end()
                    ->useAttributeAsKey('endpoints')->prototype('array')
                        ->children()
                            ->scalarNode('pattern')->end()
                            ->scalarNode('url')->end()
                            ->arrayNode('params')
                                ->useAttributeAsKey('params')->prototype('scalar')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->booleanNode('discovery')->end()
                ->arrayNode('allowedurls')
                    ->useAttributeAsKey('allowedurls')->prototype('scalar')->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
