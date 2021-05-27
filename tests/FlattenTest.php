<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait FlattenTest
{

    public function testFlatten(): void
    {
        $this->assertEquals(
            [1, 2, 3, 4],
            Arr::flatten([1, 2, [3, 4]])
        );
    }

    public function testFlattenDeep(): void
    {
        $this->assertEquals(
            [1, 2, 3, [4, 5]],
            Arr::flatten([1, 2, [3, [4, 5]]])
        );
    }

    public function testFlattenWithDepth(): void
    {
        $this->assertEquals(
            [1, 2, 3, 4, 5],
            Arr::flatten([1, 2, [3, [4, 5]]], 2)
        );
    }

}
