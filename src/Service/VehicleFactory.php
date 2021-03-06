<?php

namespace Framework\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Framework\Exception\VehicleNotAvailableException;
use Framework\Factory\AbstractVehicleFactory;
use Framework\Vehicle\VehicleInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * Class VehicleFactory
 * @package Framework\Service
 */
class VehicleFactory extends AbstractVehicleFactory
{
    /**
     * @param array $names
     * @return Collection
     */
    public function processVehicles(array $names): Collection
    {
        $vehicles = new ArrayCollection();

        foreach ($names as $name) {
            $vehicleObj = $this->processVehicle($name);
            $vehicles->add($vehicleObj);
        }

        return $vehicles;
    }

    /**
     * @param string $name
     * @return VehicleInterface
     * @throws VehicleNotAvailableException
     */
    protected function processVehicle(string $name): VehicleInterface
    {
        $nameWithNamespace = $name . $this->namespaceName;

        try {
            return $this->getContainer()->get($nameWithNamespace);
        } catch(ServiceNotFoundException $e) {
            throw new VehicleNotAvailableException(sprintf('Vehicle %s is not exist', $nameWithNamespace));
        }
    }

}
