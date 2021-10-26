<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Utility\Arr;

trait IsArrayTest
{

    public function testIsArray(): void
    {
        $this->assertTrue(
            Arr::isArray([1, 2, 3])
        );
    }

    public function testIsArrayString(): void
    {
        $this->assertFalse(
            Arr::isArray('This is a test string')
        );
    }

    public function testIsArrayBoolean(): void
    {
        $this->assertFalse(
            Arr::isArray(true)
        );
    }

    public function testIsArrayInt(): void
    {
        $this->assertFalse(
            Arr::isArray(123)
        );
    }

    public function testIsArrayFloat(): void
    {
        $this->assertFalse(
            Arr::isArray(123.456)
        );
    }

    public function testIsArrayNull(): void
    {
        $this->assertFalse(
            Arr::isArray(null)
        );
    }

}
