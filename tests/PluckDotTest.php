<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait PluckDotTest
{

    public function testPluckDot(): void
    {
        $this->assertEquals(
            [1, 3],
            Arr::pluckDot([['b' => ['d' => 1]], ['b' => ['d' => 3]]], 'b.d')
        );
    }

    public function testPluckDotMissing(): void
    {
        $this->assertEquals(
            [1, null],
            Arr::pluckDot([['b' => ['d' => 1]], ['b' => 0]], 'b.d')
        );
    }

}
