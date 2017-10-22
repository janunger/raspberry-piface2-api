<?php

declare(strict_types=1);

namespace JUIT\PiFace\Emulator;

class InputPin implements \JUIT\PiFace\InputPin
{
    /**
     * @var int
     */
    private $pinId;

    /**
     * @var \SplFileInfo
     */
    private $dataDir;

    public function __construct(int $pinId, \SplFileInfo $dataDir)
    {
        $this->pinId   = $pinId;
        $this->dataDir = $dataDir;
    }

    public function isOn(): bool
    {
        $dataFilePath = $this->createDataFilePath();

        if (!is_file($dataFilePath)) {
            return false;
        }

        return file_get_contents($dataFilePath) === '1';
    }

    public function setOn()
    {
        file_put_contents($this->createDataFilePath(), '1');
    }

    public function setOff()
    {
        file_put_contents($this->createDataFilePath(), '0');
    }

    private function createDataFilePath(): string
    {
        return $this->dataDir->getPathname() . '/input_pin_' . $this->pinId;
    }
}
