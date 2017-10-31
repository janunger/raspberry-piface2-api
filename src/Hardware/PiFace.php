<?php

declare(strict_types=1);

namespace JUIT\PiFace\Hardware;

use JUIT\PiFace\InputPinState;

class PiFace implements \JUIT\PiFace\PiFace
{
    /**
     * @var ProcessRunner
     */
    private $processRunner;

    public function __construct(ProcessRunner $processRunner = null)
    {
        if (null === $processRunner) {
            $processRunner = new ProcessRunner();
        }
        $this->processRunner = $processRunner;
    }

    public function readInputPins(): InputPinState
    {
        $output = $this->processRunner->mustRun('gpio -p readall');
        $lines = explode(PHP_EOL, $output);
        $state = [];
        for ($i = 0; $i < 8; $i++) {
            $line      = $lines[$i + 3];
            $state[$i] = $line[13];
        }

        return new InputPinState($state);
    }
}
