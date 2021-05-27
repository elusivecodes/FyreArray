<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait ExceptTest
{

    public function testExcept(): void
    {
        $this->assertEquals(
            ['b' => 2, 'd' => 4],
            Arr::except(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4], ['a', 'c'])
        );
    }

}
