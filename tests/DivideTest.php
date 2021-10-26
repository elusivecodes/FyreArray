<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Utility\Arr;

trait DivideTest
{

    public function testDivide(): void
    {
        $this->assertEquals(
            [
                ['a', 'b', 'c'],
                [1, 2, 3]
            ],
            Arr::divide(['a' => 1, 'b' => 2, 'c' => 3])
        );
    }

}
