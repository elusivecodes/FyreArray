<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Utility\Arr;

trait SliceTest
{

    public function testSlice(): void
    {
        $this->assertSame(
            [1, 2, 3],
            Arr::slice([1, 2, 3])
        );
    }

    public function testSliceWithOffset(): void
    {
        $this->assertSame(
            [3, 4, 5],
            Arr::slice([1, 2, 3, 4, 5], 2)
        );
    }

    public function testSliceWithLength(): void
    {
        $this->assertSame(
            [3, 4],
            Arr::slice([1, 2, 3, 4, 5], 2, 2)
        );
    }

    public function testSliceWithPreserveKeys(): void
    {
        $this->assertSame(
            [2 => 3, 3 => 4],
            Arr::slice([1, 2, 3, 4, 5], 2, 2, true)
        );
    }

}
