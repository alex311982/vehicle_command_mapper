<?php

namespace Framework\Vehicle;

/**
 * Interface VehicleInterface
 * @package Framework\Vehicle
 */
interface VehicleInterface
{
    /**
     * @param array $names
     * @return null
     */
    public function addCommands(array $names);

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return null
     */
    public function executeCommands();

    /**
     * @return array
     */
    public function getCommands(): array;
}
