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
use Tests\Factory\Mock\ContainerMock;
use Tests\Factory\Mock\VehicleFactoryMock;

/**
 * Class AbstractVehicleFactoryTest
 * @package Tests\Framework\Factory
 */
class AbstractVehicleFactoryTest extends TestCase
{
    /**
     * @var VehicleFactoryMock
     */
    protected $vehicleFactoryMock;

    protected function setUp()
    {
        $this->vehicleFactoryMock = new VehicleFactoryMock('vehicle');
    }

    public function testGetContainer()
    {
        $containerMock = new ContainerMock();

        $this->vehicleFactoryMock->setContainer($containerMock);

        $this->assertInstanceOf(ContainerInterface::class,
            $this->vehicleFactoryMock->getContainer());
    }

    /**
     * @expectedException \Framework\Exception\InstanceIsNotSetException
     */
    public function testGetContainerException()
    {
        $this->vehicleFactoryMock->getContainer();
    }
}
