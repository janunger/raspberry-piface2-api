<?php

declare(strict_types=1);

namespace JUIT\PiFace\Emulator;

use JUIT\PiFace\InputPinState;

class PiFace implements \JUIT\PiFace\PiFace
{
    /**
     * @var \SplFileInfo
     */
    private $dataFile;

    public function __construct(\SplFileInfo $dataFile)
    {
        $this->dataFile = $dataFile;
    }

    public function readInputPins(): InputPinState
    {
        $this->assertDataFileExists();

        return new InputPinState($this->readState());
    }

    public function setPinOn(int $pinId)
    {
        $this->assertDataFileExists();

        $state = $this->readState();
        $state[$pinId] = true;
        $this->writeState($state);
    }

    public function setPinOff(int $pinId)
    {
        $this->assertDataFileExists();

        $state = $this->readState();
        $state[$pinId] = false;
        $this->writeState($state);
    }

    private function assertDataFileExists()
    {
        if ($this->dataFile->isFile()) {
            return;
        }

        $state = [];
        for ($i = 0; $i < static::PIN_COUNT; ++$i) {
            $state[] = false;
        }
        $this->writeState($state);
    }

    private function readState(): array
    {
        return json_decode(file_get_contents($this->dataFile->getPathname()), true);
    }

    private function writeState(array $state)
    {
        file_put_contents($this->dataFile->getPathname(), json_encode($state));
    }
}
