<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Utility\Arr;

trait IntersectTest
{

    public function testIntersect(): void
    {
        $this->assertEquals(
            [0 => 1, 2 => 3, 4 => 5],
            Arr::intersect([1, 2, 3, 4, 5], [1, 3, 5])
        );
    }

    public function testIntersectNArgs(): void
    {
        $this->assertEquals(
            [0 => 1, 2 => 3],
            Arr::intersect([1, 2, 3, 4, 5], [1, 3, 5], [1, 3, 4])
        );
    }

}
