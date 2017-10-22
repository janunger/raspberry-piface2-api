<?php

declare(strict_types=1);

namespace JUIT\PiFace\Hardware;

use Symfony\Component\Process\Process;

class ProcessRunner
{
    public function mustRun(string $command): string
    {
        $process = new Process($command);
        $process->mustRun();

        return $process->getOutput();
    }
}
