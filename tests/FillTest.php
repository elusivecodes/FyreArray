<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Utility\Arr;

trait FillTest
{

    public function testFill(): void
    {
        $this->assertEquals(
            ['a', 'a', 'a'],
            Arr::fill(3, 'a')
        );
    }

}
