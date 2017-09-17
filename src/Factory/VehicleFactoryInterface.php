<?php

namespace Framework\Factory;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\DependencyInjection\ContainerInterface;

interface VehicleFactoryInterface
{
    public function processVehicles(array $names): Collection;

    public function setContainer(ContainerInterface $container);
}
