<?php

declare(strict_types=1);

namespace JUIT\PiFace\Emulator;

class OutputPin implements \JUIT\PiFace\OutputPin
{
    /**
     * @var \SplFileInfo
     */
    private $dataFile;

    /**
     * @var int
     */
    private $switchCycleCount = 0;

    public function __construct(\SplFileInfo $dataFile)
    {
        $this->dataFile = $dataFile;
    }

    public function trigger(int $durationMilliseconds)
    {
        $this->switchOn();
        usleep($durationMilliseconds * 1000);
        $this->switchOff();
    }

    public function switchOn()
    {
        $state         = $this->readState();
        $state['isOn'] = true;
        $this->writeState($state);
    }

    public function switchOff()
    {
        $state         = $this->readState();
        if ($state['isOn']) {
            $this->switchCycleCount++;
        }
        $state['isOn'] = false;
        $this->writeState($state);
    }

    public function isOn(): bool
    {
        return $this->readState()['isOn'];
    }

    private function readState(): array
    {
        $this->assertDataFileExists();

        return json_decode(file_get_contents($this->dataFile->getPathname()), true);
    }

    private function writeState(array $state)
    {
        file_put_contents($this->dataFile->getPathname(), json_encode($state));
    }

    private function assertDataFileExists()
    {
        if ($this->dataFile->isFile()) {
            return;
        }
        $this->writeState(
            [
                'isOn' => false,
            ]
        );
    }

    public function getSwitchCycleCount(): int
    {
        return $this->switchCycleCount;
    }
}
