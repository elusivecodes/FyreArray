<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait PopTest
{

    public function testPop(): void
    {
        $array = [1, 2, 3];
        $this->assertEquals(
            3,
            Arr::pop($array)
        );
    }

    public function testPopModifiesArray(): void
    {
        $array = [1, 2, 3];
        Arr::pop($array);
        $this->assertEquals(
            [1, 2],
            $array
        );
    }

    public function testPopWithEmptyArray(): void
    {
        $array = [];
        $this->assertEquals(
            null,
            Arr::pop($array)
        );
    }

}
