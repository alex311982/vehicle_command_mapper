<?php

namespace Framework\Vehicle;

interface VehicleInterface
{
    public function addCommands(array $names);

    public function getName(): string;

    public function executeCommands();
}
