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
            ->expects(static::once())->method('mustRun')
            ->with('python3 ' . PROJECT_ROOT_DIR . '/src/Hardware/bin/trigger.py 1 500');
        $SUT = new OutputPin(1, $this->processRunner);

        $SUT->trigger(500);
    }
}
