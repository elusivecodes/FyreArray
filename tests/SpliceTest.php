<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait SpliceTest
{

    public function testSplice(): void
    {
        $array = [1, 2, 3, 4, 5, 6];
        Arr::splice($array, 2);
        $this->assertEquals(
            [1, 2],
            $array
        );
    }

    public function testSpliceNegativeOffset(): void
    {
        $array = [1, 2, 3, 4, 5, 6];
        Arr::splice($array, -2);
        $this->assertEquals(
            [1, 2, 3, 4],
            $array
        );
    }

    public function testSpliceWithLength(): void
    {
        $array = [1, 2, 3, 4, 5, 6];
        Arr::splice($array, 2, 1);
        $this->assertEquals(
            [1, 2, 4, 5, 6],
            $array
        );
    }

    public function testSpliceWithNegativeLength(): void
    {
        $array = [1, 2, 3, 4, 5, 6];
        Arr::splice($array, 2, -1);
        $this->assertEquals(
            [1, 2, 6],
            $array
        );
    }

    public function testSpliceWithReplacement(): void
    {
        $array = [1, 2, 3, 4, 5, 6];
        Arr::splice($array, 2, 1, 0);
        $this->assertEquals(
            [1, 2, 0, 4, 5, 6],
            $array
        );
    }

}
