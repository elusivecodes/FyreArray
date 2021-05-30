<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait ForgetDotTest
{

    public function testForgetDot(): void
    {
        $this->assertEquals(
            [
                'a' => 1,
                'b' => [
                    'c' => 2
                ]
            ],
            Arr::forgetDot(['a' => 1, 'b' => ['c' => 2, 'd' => 3]], 'b.d')
        );
    }

    public function testForgetDotMissing(): void
    {
        $this->assertEquals(
            [
                'a' => 1,
                'b' => [
                    'c' => 2
                ]
            ],
            Arr::forgetDot(['a' => 1, 'b' => ['c' => 2]], 'b.d')
        );
    }

}
