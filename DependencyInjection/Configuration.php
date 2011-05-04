<?php

namespace BeSimple\DatagridBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class Configuration
{
    private $kernelDebug;

    /**
     * Generates the configuration tree.
     *
     * @param Boolean $kernelDebug
     * @return \Symfony\Component\Config\Definition\ArrayNode The config tree
     */
    public function getConfigTree($kernelDebug)
    {
        $this->kernelDebug = (bool)$kernelDebug;

        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('besimple_datagrid');

        $this->addFormattersSection($rootNode);

        return $treeBuilder->buildTree();
    }

    private function addFormattersSection(ArrayNodeDefinition $node)
    {
        $node
                ->children()
                ->arrayNode('formatters')
                ->prototype('array')
                ->beforeNormalization()
                ->ifString()
                ->then(function($v)
        {
            return array('class' => $v);
        })
                ->end()
                ->end()
                ->end();
    }
}
