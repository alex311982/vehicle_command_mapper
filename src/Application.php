<?php

namespace Framework;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Application
{
    protected $container;

    public function bootstrap()
    {
        $container = new ContainerBuilder();
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/Resource/config'));
        $loader->load('services.yml');

        $container->set(
            'app.container',
            $container
        );

        $this->container = $container;
    }

    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

}
