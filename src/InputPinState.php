<?php

declare(strict_types=1);

namespace JUIT\PiFace;

class InputPinState
{
    /** @var bool[] */
    private $pinStates;

    public function __construct(array $pinStates)
    {
        $this->pinStates = array_map(
            function (string $pinState): bool {
                return $pinState === '0';
            },
            $pinStates
        );
    }

    public function isPinOn(int $pinId): bool
    {
        if (!isset($this->pinStates[$pinId])) {
            throw new RuntimeException("Undefined input pin ID ({$pinId})");
        }

        return $this->pinStates[$pinId];
    }
}
