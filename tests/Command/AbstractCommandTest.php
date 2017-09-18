<?php
/**
 * Created by PhpStorm.
 * User: agubarev
 * Date: 9/18/2017
 * Time: 6:38 PM
 */

namespace Tests\Framework\Command;

use Framework\Command\AbstractCommand;
use PHPUnit\Framework\TestCase;

class AbstractCommandTest extends TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $abstractCommandMock;

    protected function setUp()
    {
        $this->abstractCommandMock = $this->getMockBuilder(AbstractCommand::class)
            ->disableOriginalConstructor()
            ->setMethods(['preExecution', 'postExecution'])
            ->getMockForAbstractClass();
    }

    /**
     * @dataProvider dataProviderToExecute
     */
    public function testExecute($returnAfterExecution, $expectedAfterExecution)
    {
        $this->abstractCommandMock
            ->expects($this->once())
            ->method('processCommand')
            ->will($this->returnValue($returnAfterExecution));

        $this->abstractCommandMock
            ->expects($this->once())
            ->method('preExecution');

        $this->abstractCommandMock
            ->expects($this->once())
            ->method('postExecution');

        $this->abstractCommandMock->execute();

        $this->assertEquals($expectedAfterExecution, $returnAfterExecution);
    }

    public function dataProviderToExecute()
    {
        return [
            [true, true],
            [false, false],
        ];
    }
}
