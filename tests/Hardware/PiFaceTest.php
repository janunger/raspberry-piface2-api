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
        $output =
"+------+---------+--------+
|  Pin | Digital | Analog |
+------+---------+--------+
|  200 |     0   |     0  |
|  201 |     1   |     0  |
|  202 |     1   |     0  |
|  203 |     1   |     0  |
|  204 |     1   |     0  |
|  205 |     1   |     0  |
|  206 |     1   |     0  |
|  207 |     1   |     0  |
|  208 |     0   |     0  |
|  209 |     0   |     0  |
|  210 |     0   |     0  |
|  211 |     0   |     0  |
|  212 |     0   |     0  |
|  213 |     0   |     0  |
|  214 |     0   |     0  |
|  215 |     0   |     0  |
+------+---------+--------+
";
        $this->processRunner
            ->expects(static::once())->method('mustRun')
            ->with('gpio -p readall')
            ->willReturn($output);

        $state = $this->SUT->readInputPins();

        static::assertTrue($state->isPinOn(0));
        static::assertFalse($state->isPinOn(1));
    }
}
