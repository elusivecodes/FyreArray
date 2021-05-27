<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait KeysTest
{

    public function testKeys(): void
    {
        $this->assertEquals(
            ['a', 'b', 'c'],
            Arr::keys(['a' => 1, 'b' => 2, 'c' => 3])
        );
    }

}
