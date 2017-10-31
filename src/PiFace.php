<?php

declare(strict_types=1);

namespace JUIT\PiFace;

interface PiFace
{
    const PIN_COUNT = 8;

    public function readInputPins(): InputPinState;
}
