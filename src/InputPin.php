<?php

declare(strict_types=1);

namespace JUIT\PiFace;

interface InputPin
{
    public function isOn(): bool;
}
