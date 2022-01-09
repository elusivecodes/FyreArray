<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Utility\Arr;

trait PadTest
{

    public function testPad(): void
    {
        $this->assertSame(
            [1, 0, 0],
            Arr::pad([1], 3, 0)
        );
    }

}
