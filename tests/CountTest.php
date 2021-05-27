<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait CountTest
{

    public function testCount(): void
    {
        $this->assertEquals(
            2,
            Arr::count(['a', 'b' => ['c']])
        );
    }

    public function testCountRecursive(): void
    {
        $this->assertEquals(
            3,
            Arr::count(['a', 'b' => ['c']], Arr::COUNT_RECURSIVE)
        );
    }

}
