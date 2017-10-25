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

    public function __construct(ProcessRunner $processRunner)
    {
        $this->processRunner = $processRunner;
    }

    public function readInputPins(): InputPinState
    {
        $command = sprintf('python3 %s/bin/read_all.py', __DIR__);
        $output = $this->processRunner->mustRun($command);

        return new InputPinState($output);
    }
}
