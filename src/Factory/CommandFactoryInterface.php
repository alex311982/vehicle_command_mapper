<?php

namespace Framework\Factory;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\DependencyInjection\ContainerInterface;

interface CommandFactoryInterface
{
    public function processCommands(array $names): Collection;

    public function setContainer(ContainerInterface $container);
}
