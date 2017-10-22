<?php

declare(strict_types=1);

namespace JUIT\PiFace\Tests\Emulator;

use JUIT\PiFace\Emulator\InputPin;
use PHPUnit\Framework\TestCase;

class InputPinTest extends TestCase
{
    /** @var string */
    private $dataDir;

    protected function setUp()
    {
        parent::setUp();
        $this->dataDir = PROJECT_ROOT_DIR . '/var/emulator';
        $this->clearDataFiles();
    }

    /** @test */
    public function it_defaults_to_off()
    {
        $SUT = new InputPin(0, new \SplFileInfo($this->dataDir));

        static::assertFalse($SUT->isOn());
    }

    /** @test */
    public function it_can_be_turned_on()
    {
        $SUT = new InputPin(0, new \SplFileInfo($this->dataDir));
        $SUT->setOn();

        static::assertTrue($SUT->isOn());
    }

    /** @test */
    public function it_can_be_turned_off_again()
    {
        $SUT = new InputPin(0, new \SplFileInfo($this->dataDir));
        $SUT->setOn();
        $SUT->setOff();

        static::assertFalse($SUT->isOn());
    }

    private function clearDataFiles()
    {
        foreach (glob($this->dataDir . '/*') as $item) {
            unlink($item);
        }
    }
}
