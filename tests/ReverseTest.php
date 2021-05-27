<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait ReverseTest
{

    public function testReverse(): void
    {
        $this->assertEquals(
            [3, 2, 1],
            Arr::reverse([1, 2, 3])
        );
    }

}
