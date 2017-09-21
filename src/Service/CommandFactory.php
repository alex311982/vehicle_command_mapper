<?php

namespace Framework\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Framework\Command\InterfaceCommand;
use Framework\Exception\CommandNotAvailableException;
use Framework\Factory\AbstractCommandFactory;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * Class CommandFactory
 * @package Framework\Service
 */
class CommandFactory extends AbstractCommandFactory
{
    /**
     * @param array $names
     * @return Collection
     */
    public function processCommands(array $names): Collection
    {
        $commands = new ArrayCollection();

        foreach ($names as $name) {
            $vehicleObj = $this->processCommand($name);
            $commands->add($vehicleObj);
        }

        return $commands;
    }

    /**
     * @param string $name
     * @return InterfaceCommand
     * @throws CommandNotAvailableException
     */
    protected function processCommand(string $name): InterfaceCommand
    {
        try {
            return $this->getContainer()->get($name . '.command');
        } catch(ServiceNotFoundException $e) {
            throw new CommandNotAvailableException('Command ' . $name . '.command is not exist');
        }
    }

}
