<?php

declare(strict_types=1);

namespace JUIT\PiFace;

interface OutputPin
{
    public function trigger(int $durationMilliseconds);

    public function switchOn();

    public function switchOff();
}
