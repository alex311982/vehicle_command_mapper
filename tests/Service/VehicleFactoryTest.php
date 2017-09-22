<?php
/**
 * Created by PhpStorm.
 * User: agubarev
 * Date: 9/19/2017
 * Time: 4:46 PM
 */

namespace Tests\Framework\Service;

use Doctrine\Common\Collections\Collection;
use Framework\Exception\VehicleNotAvailableException;
use Framework\Service\VehicleFactory;
use Framework\Vehicle\VehicleInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class VehicleFactoryTest extends TestCase
{
    /**
     * @var VehicleFactory
     */
    protected $factory;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $containerMock;

    public function setUp()
    {
        $this->factory = new VehicleFactory('vehicle');
        $this->containerMock = $this->createMock(ContainerInterface::class);

        $this->factory->setContainer($this->containerMock);
    }

    public function testProcessCommandsEmpty()
    {
        $commands = $this->factory->processVehicles([]);

        $this->assertInstanceOf(Collection::class,$commands);

        $this->assertCount(0, $commands);
    }

    public function testProcessCommands()
    {
        $this->containerMock->expects($this->at(0))
            ->method('get')
            ->with('vehicle_1.vehicle')
            ->will($this->returnValue($this->createMock(VehicleInterface::class)));

        $this->containerMock->expects($this->at(1))
            ->method('get')
            ->with('vehicle_2.vehicle')
            ->will($this->returnValue($this->createMock(VehicleInterface::class)));

        $commands = $this->factory->processVehicles(['vehicle_1', 'vehicle_2']);

        $this->assertInstanceOf(Collection::class,$commands);

        $this->assertCount(2, $commands);
    }

    /**
     * @expectedException \Framework\Exception\VehicleNotAvailableException
     */
    public function testProcessVehicleException()
    {
        $this->containerMock->expects($this->at(0))
            ->method('get')
            ->with('vehicle_1.vehicle')
            ->willThrowException(new VehicleNotAvailableException);

        $this->factory->processVehicles(['vehicle_1', 'vehicle_2']);
    }
}
