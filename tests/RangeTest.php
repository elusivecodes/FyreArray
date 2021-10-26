<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Utility\Arr;

trait RangeTest
{

    public function testRange(): void
    {
        $this->assertEquals(
            [1, 2, 3, 4, 5],
            Arr::range(1, 5)
        );
    }

    public function testRangeWithStep(): void
    {
        $this->assertEquals(
            [1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5],
            Arr::range(1, 5, .5)
        );
    }

    public function testRangeAlpha(): void
    {
        $this->assertEquals(
            ['a', 'b', 'c'],
            Arr::range('a', 'c')
        );
    }

}
