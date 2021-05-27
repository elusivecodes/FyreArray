<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait MapTest
{

    public function testMap(): void
    {
        $this->assertEquals(
            [2, 4, 6],
            Arr::map([1, 2, 3], fn($value) => $value * 2)
        );
    }

    public function testMapWithKey(): void
    {
        $this->assertEquals(
            [1, 4, 6],
            Arr::map([1, 2, 3], fn($value, $key) => $key > 0 ? $value * 2 : $value)
        );
    }

}
