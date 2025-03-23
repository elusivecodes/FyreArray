<?php
declare(strict_types=1);

namespace Tests;

use Fyre\Utility\Arr;

trait FindKeyTestTrait
{
    public function testFindKeyWithMatch(): void
    {
        $this->assertSame(
            2,
            Arr::findKey([1, 2, 3, 4, 5], fn($value) => $value > 2)
        );
    }

    public function testFindKeyWithoutMatch(): void
    {
        $this->assertNull(
            Arr::findKey([1, 2, 3, 4, 5], fn($value) => $value > 5)
        );
    }
}
