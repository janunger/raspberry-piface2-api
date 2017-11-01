<?php

declare(strict_types=1);

namespace JUIT\PiFace\Tests\Emulator;

use JUIT\PiFace\Emulator\OutputPin;
use PHPUnit\Framework\TestCase;

class OutputPinTest extends TestCase
{
    /** @var \SplFileInfo */
    private $dataFile;

    /** @var OutputPin */
    private $SUT;

    protected function setUp()
    {
        parent::setUp();
        $this->dataFile = new \SplFileInfo(PROJECT_ROOT_DIR . '/var/emulator/output_pin');
        $this->SUT = new OutputPin($this->dataFile);
        $this->clearDataFile();
    }

    /** @test */
    public function it_can_be_triggered_and_respects_duration()
    {
        static::assertFalse($this->SUT->isOn());

        $startTime = microtime(true);
        $this->SUT->trigger(500);
        $duration = microtime(true) - $startTime;

        static::assertFalse($this->SUT->isOn());
        static::assertGreaterThanOrEqual(0.490, $duration);
        static::assertLessThanOrEqual(0.510, $duration);
    }

    /** @test */
    public function it_can_be_switched_on_and_off()
    {
        static::assertFalse($this->SUT->isOn());

        $this->SUT->switchOn();
        static::assertTrue($this->SUT->isOn());

        $this->SUT->switchOff();
        static::assertFalse($this->SUT->isOn());
    }

    /** @test */
    public function it_persists_it_s_state()
    {
        $otherInstance = new OutputPin($this->dataFile);

        $this->SUT->switchOn();
        static::assertTrue($otherInstance->isOn());

        $this->SUT->switchOff();
        static::assertFalse($otherInstance->isOn());
    }

    /** @test */
    public function it_counts_switch_cycles()
    {
        static::assertSame(0, $this->SUT->getSwitchCycleCount());

        $this->SUT->switchOn();
        static::assertSame(0, $this->SUT->getSwitchCycleCount());

        $this->SUT->switchOn();
        static::assertSame(0, $this->SUT->getSwitchCycleCount());

        $this->SUT->switchOff();
        static::assertSame(1, $this->SUT->getSwitchCycleCount());

        $this->SUT->switchOff();
        static::assertSame(1, $this->SUT->getSwitchCycleCount());

        $this->SUT->trigger(0);
        static::assertSame(2, $this->SUT->getSwitchCycleCount());
    }

    /** @test */
    public function it_persists_switch_cycles()
    {
        $otherInstance = new OutputPin($this->dataFile);

        $this->SUT->trigger(0);
        $this->SUT->trigger(0);
        $this->SUT->trigger(0);

        static::assertSame(3, $otherInstance->getSwitchCycleCount());
    }

    protected function tearDown()
    {
        $this->clearDataFile();

        parent::tearDown();
    }

    private function clearDataFile()
    {
        if (!$this->dataFile->isFile()) {
            return;
        }
        unlink($this->dataFile->getPathname());
    }
}
