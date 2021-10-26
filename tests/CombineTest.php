<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Utility\Arr;

trait CombineTest
{

    public function testCombine(): void
    {
        $this->assertEquals(
            ['a' => 1, 'b' => 2],
            Arr::combine(['a', 'b'], [1, 2])
        );
    }

}
