<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Utility\Arr;

trait ReverseTest
{

    public function testReverse(): void
    {
        $this->assertSame(
            [3, 2, 1],
            Arr::reverse([1, 2, 3])
        );
    }

}
