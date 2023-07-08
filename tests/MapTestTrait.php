<?php
declare(strict_types=1);

namespace Tests;

use Fyre\Utility\Arr;

trait MapTestTrait
{

    public function testMap(): void
    {
        $this->assertSame(
            [2, 4, 6],
            Arr::map([1, 2, 3], fn($value) => $value * 2)
        );
    }

    public function testMapWithKey(): void
    {
        $this->assertSame(
            [1, 4, 6],
            Arr::map([1, 2, 3], fn($value, $key) => $key > 0 ? $value * 2 : $value)
        );
    }

}
