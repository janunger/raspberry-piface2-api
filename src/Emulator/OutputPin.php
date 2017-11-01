<?php

declare(strict_types=1);

namespace JUIT\PiFace\Emulator;

class OutputPin implements \JUIT\PiFace\OutputPin
{
    /**
     * @var \SplFileInfo
     */
    private $dataFile;

    private $isOn = false;

    public function __construct(\SplFileInfo $dataFile)
    {
        $this->dataFile = $dataFile;
    }

    public function trigger(int $durationMilliseconds)
    {
        usleep($durationMilliseconds * 1000);
    }

    public function switchOn()
    {
        $this->isOn = true;
    }

    public function switchOff()
    {
        $this->isOn = false;
    }

    public function isOn(): bool
    {
        return $this->isOn;
    }
}
