<?php
declare(strict_types=1);

namespace Tests;

use Fyre\Utility\Arr;

trait NoneTestTrait
{
    public function testNone(): void
    {
        $this->assertTrue(
            Arr::none(
                [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                fn(int $value, int $key): bool => $value >= 11
            )
        );
    }

    public function testNoneEmpty(): void
    {
        $this->assertTrue(
            Arr::none(
                [],
                fn(int $value, int $key): bool => false
            )
        );
    }

    public function testNoneFalse(): void
    {
        $this->assertFalse(
            Arr::none(
                [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                fn(int $value, int $key): bool => $value < 5
            )
        );
    }
}
