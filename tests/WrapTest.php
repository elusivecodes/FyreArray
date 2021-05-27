<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait WrapTest
{

    public function testWrap(): void
    {
        $this->assertEquals(
            [1],
            Arr::wrap(1)
        );
    }

    public function testWrapArray(): void
    {
        $this->assertEquals(
            [1],
            Arr::wrap([1])
        );
    }

    public function testWrapNull(): void
    {
        $this->assertEquals(
            [],
            Arr::wrap(null)
        );
    }

}
