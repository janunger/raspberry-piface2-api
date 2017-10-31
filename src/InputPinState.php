<?php

declare(strict_types=1);

namespace JUIT\PiFace;

class InputPinState
{
    /** @var bool[] */
    private $pinStates;

    /**
     * @param bool[] $pinStates
     */
    public function __construct(array $pinStates)
    {
        $this->pinStates = $pinStates;
    }

    public function isPin0On(): bool
    {
        return $this->pinStates[0];
    }

    public function isPin1On(): bool
    {
        return $this->pinStates[1];
    }

    public function isPin2On(): bool
    {
        return $this->pinStates[2];
    }

    public function isPin3On(): bool
    {
        return $this->pinStates[3];
    }

    public function isPin4On(): bool
    {
        return $this->pinStates[4];
    }

    public function isPin5On(): bool
    {
        return $this->pinStates[5];
    }

    public function isPin6On(): bool
    {
        return $this->pinStates[6];
    }

    public function isPin7On(): bool
    {
        return $this->pinStates[7];
    }
}
