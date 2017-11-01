<?php

declare(strict_types=1);

namespace JUIT\PiFace\Tests\Hardware;

use JUIT\PiFace\Hardware\OutputPin;
use JUIT\PiFace\Hardware\ProcessRunner;
use PHPUnit\Framework\TestCase;

class OutputPinTest extends TestCase
{
    /** @var ProcessRunner|\PHPUnit_Framework_MockObject_MockObject */
    private $processRunner;

    protected function setUp()
    {
        parent::setUp();
        $this->processRunner = $this->createMock(ProcessRunner::class);
    }

    /** @test */
    public function it_triggers_the_pin_for_a_given_time()
    {
        $this->processRunner
            ->expects(static::at(0))->method('mustRun')
            ->with('gpio -p write 201 1');
        $this->processRunner
            ->expects(static::at(1))->method('mustRun')
            ->with('gpio -p write 201 0');
        $SUT = new OutputPin(1, $this->processRunner);

        $startTime = microtime(true);
        $SUT->trigger(500);
        $duration = microtime(true) - $startTime;

        static::assertGreaterThanOrEqual(0.490, $duration);
        static::assertLessThanOrEqual(0.510, $duration);
    }

    /** @test */
    public function it_switches_the_pin_on()
    {
        $this->processRunner
            ->expects(static::once())->method('mustRun')
            ->with('gpio -p write 200 1');
        $SUT = new OutputPin(0, $this->processRunner);

        $SUT->switchOn();
    }

    /** @test */
    public function it_switches_the_pin_off()
    {
        $this->processRunner
            ->expects(static::once())->method('mustRun')
            ->with('gpio -p write 202 0');
        $SUT = new OutputPin(2, $this->processRunner);

        $SUT->switchOff();
    }
}
