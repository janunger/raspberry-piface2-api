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
