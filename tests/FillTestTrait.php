<?php
declare(strict_types=1);

namespace Tests;

use Fyre\Utility\Arr;

trait FillTestTrait
{
    public function testFill(): void
    {
        $this->assertSame(
            ['a', 'a', 'a'],
            Arr::fill(3, 'a')
        );
    }
}
