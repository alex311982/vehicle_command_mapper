<?php

namespace Framework\Factory;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Framework\Exception\InstanceIsNotSetException;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class AbstractCommandFactory
 * @package Framework\Factory
 */
abstract class AbstractCommandFactory implements CommandFactoryInterface
{
    /**
     * @var Collection
     */
    protected $commands;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * AbstractCommandFactory constructor.
     */
    public function __construct()
    {
        $this->commands = new ArrayCollection();
    }

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    protected function getContainer(): ContainerInterface
    {
        if (!$this->container instanceof ContainerInterface) {
            throw new InstanceIsNotSetException('Container is no set for class ' . __CLASS__);
        }

        return $this->container;
    }

    /**
     * @param array $names
     * @return Collection
     */
    abstract public function processCommands(array $names): Collection;
}
