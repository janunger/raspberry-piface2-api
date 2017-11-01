<?php

declare(strict_types=1);

namespace JUIT\PiFace\Tests\Emulator;

use JUIT\PiFace\Emulator\PiFace;
use PHPUnit\Framework\TestCase;

class PiFaceTest extends TestCase
{
    /** @var \SplFileInfo */
    private $dataFile;

    protected function setUp()
    {
        parent::setUp();
        $this->dataFile = new \SplFileInfo(PROJECT_ROOT_DIR . '/var/emulator/input_pins');
        $this->clearDataFile();
    }

    /** @test */
    public function it_defaults_to_all_pins_off()
    {
        $pinCount = 8;
        $SUT      = new PiFace($this->dataFile);

        $state = $SUT->readInputPins();

        static::assertFalse($state->isPin0On());
        static::assertFalse($state->isPin1On());
        static::assertFalse($state->isPin2On());
        static::assertFalse($state->isPin3On());
        static::assertFalse($state->isPin4On());
        static::assertFalse($state->isPin5On());
        static::assertFalse($state->isPin6On());
        static::assertFalse($state->isPin7On());
    }

    /** @test */
    public function it_can_turn_a_pin_on()
    {
        $SUT = new PiFace($this->dataFile);

        $SUT->setPinOn(1);

        $state = $SUT->readInputPins();
        static::assertFalse($state->isPin0On());
        static::assertTrue($state->isPin1On());
        static::assertFalse($state->isPin2On());
    }

    /** @test */
    public function it_can_turn_a_pin_off_again()
    {
        $pinCount = 3;
        $SUT      = new PiFace($this->dataFile);

        $SUT->setPinOn(1);
        $SUT->setPinOff(1);

        $state = $SUT->readInputPins();
        static::assertFalse($state->isPin0On());
        static::assertFalse($state->isPin1On());
        static::assertFalse($state->isPin2On());
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
