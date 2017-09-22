<?php
/**
 * Created by PhpStorm.
 * User: agubarev
 * Date: 9/18/2017
 * Time: 7:18 PM
 */

namespace Tests\Framework\Factory;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Tests\Factory\Mock\CommandFactoryMock;
use Tests\Factory\Mock\ContainerMock;

/**
 * Class AbstractCommandFactoryTest
 * @package Tests\Framework\Factory
 */
class AbstractCommandFactoryTest extends TestCase
{
    /**
     * @var CommandFactoryMock
     */
    protected $commandFactoryMock;

    protected function setUp()
    {
        $this->commandFactoryMock = new CommandFactoryMock('command');
    }

    public function testGetContainer()
    {
        $containerMock = new ContainerMock();

        $this->commandFactoryMock->setContainer($containerMock);

        $this->assertInstanceOf(ContainerInterface::class,
            $this->commandFactoryMock->getContainer());
    }

    /**
     * @expectedException \Framework\Exception\InstanceIsNotSetException
     */
    public function testGetContainerException()
    {
        $this->commandFactoryMock->getContainer();
    }
}
