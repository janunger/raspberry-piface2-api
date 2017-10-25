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
        $SUT      = new PiFace($this->dataFile, $pinCount);

        $state = $SUT->readInputPins();

        for ($i = 0; $i < $pinCount; ++$i) {
            static::assertFalse($state->isPinOn($i));
        }
    }

    /** @test */
    public function it_can_turn_a_pin_on()
    {
        $pinCount = 3;
        $SUT      = new PiFace($this->dataFile, $pinCount);

        $SUT->setPinOn(1);

        $state = $SUT->readInputPins();
        static::assertFalse($state->isPinOn(0));
        static::assertTrue($state->isPinOn(1));
        static::assertFalse($state->isPinOn(2));
    }

    /** @test */
    public function it_can_turn_a_pin_off_again()
    {
        $pinCount = 3;
        $SUT      = new PiFace($this->dataFile, $pinCount);

        $SUT->setPinOn(1);
        $SUT->setPinOff(1);

        $state = $SUT->readInputPins();
        static::assertFalse($state->isPinOn(0));
        static::assertFalse($state->isPinOn(1));
        static::assertFalse($state->isPinOn(2));
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
