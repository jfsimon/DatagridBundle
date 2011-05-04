<?php

namespace BeSimple\DatagridBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Bundle\DoctrineAbstractBundle\DependencyInjection\AbstractDoctrineExtension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Processor;

class DatagridExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $configuration = new Configuration();
        $processor = new Processor();
        $config = $processor->process($configuration->getConfigTree($container->getParameter('kernel.debug')), $configs);

        // todo: make this better
        $container->setParameter('besimple_datagrid.factory_parameters', $container->getParameterBag());

        //$this->loadDatasource(isset($config['datasources']) ? $config['datasources'] : array(), $loader, $container);
        $this->loadFormatters(isset($config['formatters']) ? $config['formatters'] : array(), $loader, $container);
        //$this->loadDatagrid  (isset($config['datagrids'])   ? $config['datagrids']   : array(), $loader, $container);
    }

    protected function loadFormatters(array $configs, XmlFileLoader $loader, ContainerBuilder $container)
    {
        $loader->load('fomatters.xml');

        // defaults for formatters options
        $defaults = array();

        foreach ($configs as $type => $config) {

            // class name definition
            if (isset($config['class'])) {
                if (!is_string($config['class'])) {
                    throw new \InvalidArgumentException(sprintf('"%s" type class should be a string.', $type));
                }
                if (class_exists($config['class'])) {
                    throw new \InvalidArgumentException(sprintf('"%s" class not found.', $config['class']));
                }
                $container->setParameter(sprintf('besimple_datagrid.formatter.class.%s', $type), $config['class']);
            }

            // type alias definition
            if (isset($config['alias'])) {
                if (!is_array($config['alias'])) {
                    $config['alias'] = array($config['alias']);

                    foreach ($config['alias'] as $alias) {
                        if (!is_string($alias)) {
                            throw new \InvalidArgumentException(sprintf('"%s" type alias should be a string.', $type));
                        }
                        $container->setParameter(sprintf('besimple_datagrid.formatter.aliases.%s', $alias), $type);
                    }
                }
            }

            // defaults definition
            $defaults[$type] = array();
            foreach ($config as $name => $value) {
                if (!in_array($name, array('class', 'alias'))) {
                    $defaults[$name] = $value;
                }
            }
        }

        $container->setParameter('besimple_datagrid.formatter.defaults', $defaults);
    }
}
