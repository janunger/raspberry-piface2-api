<?php

declare(strict_types=1);

namespace JUIT\PiFace\Hardware;

class OutputPin implements \JUIT\PiFace\OutputPin
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

    public function trigger(int $durationMilliseconds)
    {
        $command = sprintf('python3 %s/bin/trigger.py %s %s', __DIR__, $this->id, $durationMilliseconds);
        $this->processRunner->mustRun($command);
    }
}
