<?php
declare(strict_types=1);

namespace Tests;

use Fyre\Utility\Arr;

trait KeysTestTrait
{

    public function testKeys(): void
    {
        $this->assertSame(
            ['a', 'b', 'c'],
            Arr::keys(['a' => 1, 'b' => 2, 'c' => 3])
        );
    }

}
