<?php

declare(strict_types=1);

namespace JUIT\PiFace\Tests;

use JUIT\PiFace\InputPinState;
use JUIT\PiFace\RuntimeException;
use PHPUnit\Framework\TestCase;

class InputPinStateTest extends TestCase
{
    /** @test */
    public function it_transforms_the_bash_script_output()
    {
        $SUT = new InputPinState([
            0 => '1',
            1 => '0',
            2 => '1',
            3 => '1',
            4 => '0',
            5 => '1',
            6 => '1',
            7 => '1',
        ]);

        static::assertFalse($SUT->isPinOn(0));
        static::assertTrue($SUT->isPinOn(1));
        static::assertFalse($SUT->isPinOn(2));
        static::assertFalse($SUT->isPinOn(3));
        static::assertTrue($SUT->isPinOn(4));
        static::assertFalse($SUT->isPinOn(5));
        static::assertFalse($SUT->isPinOn(6));
        static::assertFalse($SUT->isPinOn(7));
    }

    /** @test */
    public function it_throws_an_exception_if_pin_id_is_unknown()
    {
        $SUT = new InputPinState([
            0 => '1',
            1 => '0',
            2 => '1',
            3 => '1',
            4 => '0',
            5 => '1',
            6 => '1',
            7 => '1',
        ]);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Undefined input pin ID (8)');
        $SUT->isPinOn(8);
    }
}
