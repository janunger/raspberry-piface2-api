<?php

declare(strict_types=1);

namespace JUIT\PiFace\Hardware;

class InputPin extends Pin implements \JUIT\PiFace\InputPin
{
    public function isOn(): bool
    {
        $command = sprintf('python3 %s/bin/read.py %s', __DIR__, $this->id);
        $output = $this->processRunner->mustRun($command);

        return trim($output) === '1';
    }
}
