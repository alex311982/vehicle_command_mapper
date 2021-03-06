<?php

namespace Framework\Vehicle;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Framework\Factory\CommandFactoryInterface;

/**
 * Class Vehicle
 * @package Framework\Vehicle
 */
class Vehicle implements VehicleInterface
{
    /**
     * @var CommandFactoryInterface
     */
    protected $commandFactory;

    /**
     * @var Collection
     */
    protected $commands;

    /**
     * @var string
     */
    protected $name;

    /**
     * Vehicle constructor.
     * @param string $name
     * @param CommandFactoryInterface $commandFactory
     */
    public function __construct(string $name, CommandFactoryInterface $commandFactory)
    {
        $this->commands = new ArrayCollection();
        $this->name = $name;
        $this->commandFactory = $commandFactory;
    }

    /**
     * @param array $names
     * @return null
     */
    public function addCommands(array $names)
    {
        $commands = $this->commandFactory->processCommands($names);

        $this->commands = new ArrayCollection(
            array_merge($this->commands->toArray(), $commands->toArray())
        );
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getCommands(): array
    {
        return $this->commands->toArray();
    }

    /**
     * @return null
     */
    public function executeCommands()
    {
        foreach ($this->getCommands() as $command) {
            $command->execute();
        }
    }

}
