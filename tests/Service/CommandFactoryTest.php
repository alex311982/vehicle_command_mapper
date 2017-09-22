<?php
/**
 * Created by PhpStorm.
 * User: agubarev
 * Date: 9/19/2017
 * Time: 2:30 PM
 */

namespace Tests\Framework\Service;

use Doctrine\Common\Collections\Collection;
use Framework\Command\InterfaceCommand;
use Framework\Exception\CommandNotAvailableException;
use Framework\Service\CommandFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CommandFactoryTest extends TestCase
{
    /**
     * @var CommandFactory
     */
    protected $factory;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $containerMock;

    public function setUp()
    {
        $this->factory = new CommandFactory('command');
        $this->containerMock = $this->createMock(ContainerInterface::class);

        $this->factory->setContainer($this->containerMock);
    }

    public function testProcessCommandsEmpty()
    {
        $commands = $this->factory->processCommands([]);

        $this->assertInstanceOf(Collection::class,$commands);

        $this->assertCount(0, $commands);
    }

    public function testProcessCommands()
    {
        $this->containerMock->expects($this->at(0))
            ->method('get')
            ->with('command_1.command')
            ->will($this->returnValue($this->createMock(InterfaceCommand::class)));
        $this->factory->setContainer($this->containerMock);

        $this->containerMock->expects($this->at(1))
            ->method('get')
            ->with('command_2.command')
            ->will($this->returnValue($this->createMock(InterfaceCommand::class)));

        $commands = $this->factory->processCommands(['command_1', 'command_2']);

        $this->assertInstanceOf(Collection::class,$commands);

        $this->assertCount(2, $commands);
    }

    /**
     * @expectedException \Framework\Exception\CommandNotAvailableException
     */
    public function testProcessCommandsException()
    {
        $this->containerMock->expects($this->at(0))
            ->method('get')
            ->with('command_1.command')
            ->willThrowException(new CommandNotAvailableException);

        $this->factory->processCommands(['command_1', 'command_2']);
    }
}
