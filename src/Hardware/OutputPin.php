<?php

declare(strict_types=1);

namespace JUIT\PiFace\Hardware;

class OutputPin extends Pin implements \JUIT\PiFace\OutputPin
{
    public function trigger(int $durationMilliseconds)
    {
        $command = sprintf('python3 %s/bin/trigger.py %s %s', __DIR__, $this->id, $durationMilliseconds);
        $this->processRunner->mustRun($command);
    }
}
