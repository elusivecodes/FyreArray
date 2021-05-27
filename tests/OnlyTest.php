<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait OnlyTest
{

    public function testOnly(): void
    {
        $this->assertEquals(
            ['a' => 1, 'c' => 3],
            Arr::only(['a' => 1, 'b' => 2, 'c' => 3], ['a', 'c'])
        );
    }

}
