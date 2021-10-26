<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Utility\Arr;

trait HasKeyTest
{

    public function testHasKeyWithMatch(): void
    {
        $this->assertTrue(
            Arr::hasKey(['a' => 1, 'b' => 2], 'a')
        );
    }

    public function testHasKeyWithoutMatch(): void
    {
        $this->assertFalse(
            Arr::hasKey(['a' => 1, 'b' => 2], 'c')
        );
    }

}
