<?php
/**
 * Created by PhpStorm.
 * User: agubarev
 * Date: 9/18/2017
 * Time: 2:26 PM
 */

namespace Test\Framework\Vehicle;

use Doctrine\Common\Collections\ArrayCollection;
use Framework\Command\InterfaceCommand;
use Framework\Factory\CommandFactoryInterface;
use Framework\Vehicle\Vehicle;
use Framework\Vehicle\VehicleInterface;
use PHPUnit\Framework\TestCase;

class VehicleTest extends TestCase
{
    /**
     * @var VehicleInterface
     */
    protected $vehicle;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $commandFactoryMock;

    protected function setUp()
    {
        $this->commandFactoryMock = $this->getMockBuilder(CommandFactoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->vehicle = new Vehicle('test_vehicle', $this->commandFactoryMock);
    }

    public function testAddCommands()
    {
        $map = [
            [['vehicle_1','vehicle_2'], new ArrayCollection(['vehicle_1_resolved','vehicle_2_resolved'])],
            [['vehicle_3','vehicle_4'], new ArrayCollection(['vehicle_3_resolved','vehicle_4_resolved'])],
        ];

        $this->commandFactoryMock->expects(($this->exactly(2)))
            ->method('processCommands')
            ->will($this->returnValueMap($map));

        $this->vehicle->addCommands(['vehicle_1','vehicle_2']);
        $this->assertCount(2, $this->vehicle->getCommands());
        $this->assertEquals(
            ['vehicle_1_resolved','vehicle_2_resolved'],
            $this->vehicle->getCommands());

        $this->vehicle->addCommands(['vehicle_3','vehicle_4']);
        $this->assertCount(4, $this->vehicle->getCommands());
        $this->assertEquals(
            ['vehicle_1_resolved','vehicle_2_resolved','vehicle_3_resolved','vehicle_4_resolved'],
            $this->vehicle->getCommands());
    }

    public function testExecuteCommands()
    {
        $commandMock1 = $this->getMockBuilder(InterfaceCommand::class)
            ->disableOriginalConstructor()
            ->getMock();
        $commandMock1->expects($this->once())
            ->method('execute');

        $commandMock2 = $this->getMockBuilder(InterfaceCommand::class)
            ->disableOriginalConstructor()
            ->getMock();
        $commandMock2->expects($this->once())
            ->method('execute');

        $map = [
            [['vehicle_1','vehicle_2'], new ArrayCollection([$commandMock1, $commandMock2])],
        ];

        $this->commandFactoryMock->expects(($this->once()))
            ->method('processCommands')
            ->will($this->returnValueMap($map));

        $this->vehicle->addCommands(['vehicle_1','vehicle_2']);
        $this->vehicle->executeCommands();
    }

}
