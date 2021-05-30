<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait SetDotTest
{

    public function testSetDot(): void
    {
        $this->assertEquals(
            [
                'a' => 1,
                'b' => [
                    'c' => 2,
                    'd' => 3
                ]
            ],
            Arr::setDot(['a' => 1, 'b' => ['c' => 2]], 'b.d', 3)
        );
    }

    public function testSetDotOverwrites(): void
    {
        $this->assertEquals(
            [
                'a' => 1,
                'b' => [
                    'c' => 2,
                    'd' => 3
                ]
            ],
            Arr::setDot(['a' => 1, 'b' => ['c' => 2, 'd' => 0]], 'b.d', 3)
        );
    }

    public function testSetDotWithOverwrite(): void
    {
        $this->assertEquals(
            [
                'a' => 1,
                'b' => [
                    'c' => 2,
                    'd' => 0
                ]
            ],
            Arr::setDot(['a' => 1, 'b' => ['c' => 2, 'd' => 0]], 'b.d', 3, false)
        );
    }

}
