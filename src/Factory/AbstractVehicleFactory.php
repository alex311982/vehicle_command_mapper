<?php

namespace Framework\Factory;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Framework\Exception\InstanceIsNotSetException;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class AbstractVehicleFactory
 * @package Framework\Factory
 */
abstract class AbstractVehicleFactory implements VehicleFactoryInterface
{
    /**
     * @var ArrayCollection
     */
    protected $vehicles;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * AbstractVehicleFactory constructor.
     */
    public function __construct()
    {
        $this->vehicles = new ArrayCollection();
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
    abstract public function processVehicles(array $names) : Collection;

}
