<?php

namespace Framework\Factory;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Interface VehicleFactoryInterface
 * @package Framework\Factory
 */
interface VehicleFactoryInterface
{
    /**
     * @param array $names
     * @return Collection
     */
    public function processVehicles(array $names): Collection;

    /**
     * @param ContainerInterface $container
     * @return null
     */
    public function setContainer(ContainerInterface $container);
}
