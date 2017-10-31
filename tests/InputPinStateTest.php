<?php

declare(strict_types=1);

namespace JUIT\PiFace\Tests;

use JUIT\PiFace\InputPinState;
use PHPUnit\Framework\TestCase;

class InputPinStateTest extends TestCase
{
    /** @test */
    public function it_maps_the_given_array_to_pin_states()
    {
        $SUT = new InputPinState([
            false,
            true,
            false,
            false,
            true,
            false,
            false,
            false,
        ]);

        static::assertFalse($SUT->isPin0On());
        static::assertTrue($SUT->isPin1On());
        static::assertFalse($SUT->isPin2On());
        static::assertFalse($SUT->isPin3On());
        static::assertTrue($SUT->isPin4On());
        static::assertFalse($SUT->isPin5On());
        static::assertFalse($SUT->isPin6On());
        static::assertFalse($SUT->isPin7On());
    }
}
