<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Utility\Arr;

trait ReduceTest
{

    public function testReduce(): void
    {
        $this->assertEquals(
            6,
            Arr::reduce([1, 2, 3], fn($acc, $value) => $acc + $value, 0)
        );
    }

}
