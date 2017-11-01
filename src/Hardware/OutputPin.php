<?php

declare(strict_types=1);

namespace JUIT\PiFace\Hardware;

class OutputPin implements \JUIT\PiFace\OutputPin
{
    /** @var string */
    private $gpioId;

    /** @var ProcessRunner */
    private $processRunner;

    public function __construct(int $id, ProcessRunner $processRunner = null)
    {
        $this->gpioId = (string)(200 + $id);

        if (!$processRunner) {
            $processRunner = new ProcessRunner();
        }
        $this->processRunner = $processRunner;
    }

    public function trigger(int $durationMilliseconds)
    {
        $this->switchOn();
        usleep($durationMilliseconds * 1000);
        $this->switchOff();
    }

    public function switchOn()
    {
        $command = sprintf('gpio -p write ' . $this->gpioId . ' 1');
        $this->processRunner->mustRun($command);
    }

    public function switchOff()
    {
        $command = sprintf('gpio -p write ' . $this->gpioId . ' 0');
        $this->processRunner->mustRun($command);
    }
}
