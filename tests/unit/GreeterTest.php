<?php 

namespace Kouz\Tests;

use Kouz\Greeter;
use Kouz\Mocks\DateTimeMock;
use PHPUnit_Framework_TestCase;

class GreeterTest extends PHPUnit_Framework_TestCase
{
    public function greetingAndHourProvider()
    {
        return [
            'whenTimeIs5am' => [
                'expectedGreeting' => "Good morning",
                'hour' => 5,
            ],
            'whenTimeIs11am' => [
                'expectedGreeting' => "Good morning",
                'hour' => 11,
            ],
            'whenTimeIs12pm' => [
                'expectedGreeting' => "Good afternoon",
                'hour' => 12,
            ],
            'whenTimeIs4pm' => [
                'expectedGreeting' => "Good afternoon",
                'hour' => 16,
            ],
            'whenTimeIs5pm' => [
                'expectedGreeting' => "Good evening",
                'hour' => 17,
            ],
            'whenTimeIs4am' => [
                'expectedGreeting' => "Good evening",
                'hour' => 4,
            ]
        ];
    }

    public function setup()
    {
        $this->greeter = new Greeter();    
    }

    /**
     * @dataProvider greetingAndHourProvider
     */
    public function testGreetUserReturnsExpectedGreetingWithDiyMock($expectedGreeting, $hour)
    {
        $dateTimeMock = new DateTimeMock();
        $dateTimeMock->formatReturn = $hour;
        $this->greeter->setDateTime($dateTimeMock);

        $actualGreeting = $this->greeter->greetUser();

        $this->assertEquals($expectedGreeting, $actualGreeting); 
        $this->assertCount(1, $dateTimeMock->formatHistory); 
        $this->assertEquals('H', $dateTimeMock->formatHistory[0]); 
    }

    /**
     * @dataProvider greetingAndHourProvider
     */
    public function testGreetUserReturnsExpectedGreetingWithFrameworkMock($expectedGreeting, $hour)
    {
        $dateTimeMock = $this->getMockBuilder('DateTime')
                             ->setMethods(['format'])
                             ->getMock();

        $dateTimeMock->expects($this->once())
                     ->method('format')
                     ->with($this->equalTo('H'))
                     ->willReturn($hour);

        $this->greeter->setDateTime($dateTimeMock);

        $actualGreeting = $this->greeter->greetUser();

        $this->assertEquals($expectedGreeting, $actualGreeting); 
    }
}
