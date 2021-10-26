<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Utility\Arr;

trait FindTest
{

    public function testFindWithMatch(): void
    {
        $this->assertEquals(
            3,
            Arr::find([1, 2, 3, 4, 5], fn($value) => $value > 2)
        );
    }

    public function testFindWithoutMatch(): void
    {
        $this->assertEquals(
            null,
            Arr::find([1, 2, 3, 4, 5], fn($value) => $value > 5)
        );
    }

    public function testFindWithDefault(): void
    {
        $this->assertEquals(
            6,
            Arr::find([1, 2, 3, 4, 5], fn($value) => $value > 5, 6),
        );
    }

}
