<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait DotTest
{

    public function testDot(): void
    {
        $this->assertEquals(
            [
                'a' => 1,
                'b.c' => 2,
                'b.d.e' => 3,
                'b.d.f' => 4
            ],
            Arr::dot(['a' => 1, 'b' => ['c' => 2, 'd' => ['e' => 3, 'f' => 4]]])
        );
    }

    public function testDotNumeric(): void
    {
        $this->assertEquals(
            [
                'a.0' => 1,
                'a.1' => 2,
                'a.2' => 3
            ],
            Arr::dot(['a' => [1, 2, 3]])
        );
    }

}