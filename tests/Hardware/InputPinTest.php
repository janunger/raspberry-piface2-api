<?php

declare(strict_types=1);

namespace JUIT\PiFace\Tests\Hardware;

use JUIT\PiFace\Hardware\InputPin;
use JUIT\PiFace\Hardware\ProcessRunner;
use PHPUnit\Framework\TestCase;

class InputPinTest extends TestCase
{
    /** @var ProcessRunner|\PHPUnit_Framework_MockObject_MockObject */
    private $processRunner;

    protected function setUp()
    {
        parent::setUp();
        $this->processRunner = $this->createMock(ProcessRunner::class);
    }

    /** @test */
    public function it_tells_if_pin_is_on()
    {
        $this->processRunner
            ->expects(static::once())->method('mustRun')
            ->with('python3 ' . PROJECT_ROOT_DIR . '/src/Hardware/bin/read.py 3')
            ->willReturn('1' . PHP_EOL);
        $SUT = new InputPin(3, $this->processRunner);

        static::assertTrue($SUT->isOn());
    }

    /** @test */
    public function it_tells_if_pin_is_off()
    {
        $this->processRunner
            ->expects(static::once())->method('mustRun')
            ->with('python3 ' . PROJECT_ROOT_DIR . '/src/Hardware/bin/read.py 0')
            ->willReturn('0' . PHP_EOL);
        $SUT = new InputPin(0, $this->processRunner);

        static::assertFalse($SUT->isOn());
    }
}
