<?php

declare(strict_types=1);

namespace JUIT\PiFace\Hardware;

use Symfony\Component\Process\Process;

class ProcessRunner
{
    /**
     * @var string
     */
    private $command = '';

    /**
     * @var Process
     */
    private $process;

    public function mustRun(string $command): string
    {
        if ($this->command !== $command) {
            $this->command = $command;
            $this->process = new Process($this->command);
        }

        $this->process->mustRun();

        return $this->process->getOutput();
    }
}
