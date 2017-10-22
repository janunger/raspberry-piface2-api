<?php

declare(strict_types=1);

namespace JUIT\PiFace\Emulator;

class OutputPin implements \JUIT\PiFace\OutputPin
{
    public function trigger(int $durationMilliseconds)
    {
        usleep($durationMilliseconds * 1000);
    }
}
