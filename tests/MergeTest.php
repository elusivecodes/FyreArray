<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait MergeTest
{

    public function testMerge(): void
    {
        $this->assertEquals(
            [1, 2, 3, 4],
            Arr::merge([1, 2], [3, 4])
        );
    }

    public function testMergeAssoc(): void
    {
        $this->assertEquals(
            ['a' => 1, 'b' => 3, 'c' => 4],
            Arr::merge(['a' => 1, 'b' => 2], ['b' => 3, 'c' => 4])
        );
    }

    public function testMergeNArgs(): void
    {
        $this->assertEquals(
            [1, 2, 3, 4, 5, 6],
            Arr::merge([1, 2], [3, 4], [5, 6])
        );
    }

}
