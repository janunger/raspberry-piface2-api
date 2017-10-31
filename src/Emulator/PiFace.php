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

    /**
     * @var int
     */
    private $pinCount;

    public function __construct(\SplFileInfo $dataFile, int $pinCount = 8)
    {
        $this->dataFile = $dataFile;
        $this->pinCount = $pinCount;
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
        $state[$pinId] = '0';
        $this->writeState($state);
    }

    public function setPinOff(int $pinId)
    {
        $this->assertDataFileExists();

        $state = $this->readState();
        $state[$pinId] = '1';
        $this->writeState($state);
    }

    private function assertDataFileExists()
    {
        if ($this->dataFile->isFile()) {
            return;
        }

        $state = [];
        for ($i = 0; $i < $this->pinCount; ++$i) {
            $state[] = '1';
        }
        $this->writeState($state);
    }

    private function readState(): array
    {
        return str_split(file_get_contents($this->dataFile->getPathname()));
    }

    private function writeState(array $content)
    {
        file_put_contents($this->dataFile->getPathname(), implode('', $content));
    }
}
