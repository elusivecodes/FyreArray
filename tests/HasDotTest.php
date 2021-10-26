<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Utility\Arr;

trait HasDotTest
{

    public function testHasDot(): void
    {
        $this->assertTrue(
            Arr::hasDot(['a' => 1, 'b' => ['c' => 2, 'd' => 3]], 'b.d')
        );
    }

    public function testHasDotFalse(): void
    {
        $this->assertFalse(
            Arr::hasDot(['a' => 1, 'b' => ['c' => 2]], 'b.d')
        );
    }

}
