<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait ValuesTest
{

    public function testValues(): void
    {
        $this->assertEquals(
            [1, 2, 3],
            Arr::values(['a' => 1, 'b' => 2, 'c' => 3])
        );
    }

}
