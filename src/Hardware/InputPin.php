<?php

declare(strict_types=1);

namespace JUIT\PiFace\Hardware;

class InputPin implements \JUIT\PiFace\InputPin
{
    /** @var int */
    private $id;

    /** @var ProcessRunner */
    private $processRunner;

    public function __construct(int $id, ProcessRunner $processRunner = null)
    {
        $this->id = $id;

        if (!$processRunner) {
            $processRunner = new ProcessRunner();
        }
        $this->processRunner = $processRunner;
    }

    public function isOn(): bool
    {
        $command = sprintf('python3 %s/bin/read.py %s', __DIR__, $this->id);
        $output = $this->processRunner->mustRun($command);

        return trim($output) === '1';
    }
}
