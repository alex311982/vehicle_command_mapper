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
     * @var string
     */
    protected $namespaceName;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * AbstractCommandFactory constructor.
     * @param null|string $namespaceName
     */
    public function __construct(?string $namespaceName)
    {
        if (is_null($this->namespaceName)) {
            $this->namespaceName = '';
        }

        $this->namespaceName = '.' . $namespaceName;
    }

    /**
     * @param ContainerInterface $container
     * @return null
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param array $names
     * @return Collection
     */
    abstract public function processVehicles(array $names) : Collection;

    /**
     * @return ContainerInterface
     * @throws InstanceIsNotSetException
     */
    protected function getContainer(): ContainerInterface
    {
        if (!$this->container instanceof ContainerInterface) {
            throw new InstanceIsNotSetException('Container is no set for class ' . __CLASS__);
        }

        return $this->container;
    }
}
