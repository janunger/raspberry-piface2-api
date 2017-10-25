<?php

declare(strict_types=1);

namespace JUIT\PiFace\Tests\Hardware;

use JUIT\PiFace\Hardware\PiFace;
use JUIT\PiFace\Hardware\ProcessRunner;
use PHPUnit\Framework\TestCase;

class PiFaceTest extends TestCase
{
    /** @var PiFace */
    private $SUT;

    /** @var ProcessRunner|\PHPUnit_Framework_MockObject_MockObject */
    private $processRunner;

    protected function setUp()
    {
        parent::setUp();
        $this->processRunner = $this->createMock(ProcessRunner::class);
        $this->SUT           = new PiFace($this->processRunner);
    }

    /** @test */
    public function it_reads_all_input_pin_states_at_once()
    {
        $this->processRunner
            ->expects(static::once())->method('mustRun')
            ->with('python3 ' . PROJECT_ROOT_DIR . '/src/Hardware/bin/read_all.py')
            ->willReturn('10000000' . PHP_EOL);

        $state = $this->SUT->readInputPins();

        static::assertTrue($state->isPinOn(0));
        static::assertFalse($state->isPinOn(1));
    }
}
