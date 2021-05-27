<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait FilterTest
{

    public function testFilter(): void
    {
        $this->assertEquals(
            [1 => 1, 3 => 2, 4 =>3],
            Arr::filter([0, 1, '', 2, 3])
        );
    }

    public function testFilterWithCallback(): void
    {
        $this->assertEquals(
            [2 => 3, 3 => 4, 4 => 5],
            Arr::filter([1, 2, 3, 4, 5], fn($value) => $value > 2)
        );
    }

    public function testFilterWithMode(): void
    {
        $this->assertEquals(
            [3 => 4, 4 => 5],
            Arr::filter([1, 2, 3, 4, 5], fn($key) => $key > 2, Arr::FILTER_KEY)
        );
    }

}