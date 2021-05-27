<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait FindLastTest
{

    public function testFindLastWithMatch(): void
    {
        $this->assertEquals(
            2,
            Arr::findLast([1, 2, 3, 4, 5], fn($value) => $value < 3)
        );
    }

    public function testFindLastWithoutMatch(): void
    {
        $this->assertEquals(
            null,
            Arr::findLast([1, 2, 3, 4, 5], fn($value) => $value < 1)
        );
    }

    public function testFindLastWithDefault(): void
    {
        $this->assertEquals(
            0,
            Arr::findLast([1, 2, 3, 4, 5], fn($value) => $value < 1, 0),
        );
    }

}
