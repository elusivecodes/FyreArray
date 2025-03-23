<?php
declare(strict_types=1);

namespace Tests;

use Fyre\Utility\Arr;

trait FindLastKeyTestTrait
{
    public function testFindLastKeyWithMatch(): void
    {
        $this->assertSame(
            1,
            Arr::findLastKey([1, 2, 3, 4, 5], fn($value) => $value < 3)
        );
    }

    public function testFindLastKeyWithoutMatch(): void
    {
        $this->assertNull(
            Arr::findLastKey([1, 2, 3, 4, 5], fn($value) => $value < 1)
        );
    }
}
