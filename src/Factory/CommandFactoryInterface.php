<?php

namespace Framework\Factory;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Interface CommandFactoryInterface
 * @package Framework\Factory
 */
interface CommandFactoryInterface
{
    /**
     * @param array $names
     * @return Collection
     */
    public function processCommands(array $names): Collection;

    /**
     * @param ContainerInterface $container
     * @return null
     */
    public function setContainer(ContainerInterface $container);
}
