<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Utility\Arr;

trait ShiftTest
{

    public function testShift(): void
    {
        $array = [1, 2, 3];
        $this->assertEquals(
            1,
            Arr::shift($array)
        );
    }

    public function testShiftModifiesArray(): void
    {
        $array = [1, 2, 3];
        Arr::shift($array);
        $this->assertEquals(
            [2, 3],
            $array
        );
    }

    public function testShiftWithEmptyArray(): void
    {
        $array = [];
        $this->assertEquals(
            null,
            Arr::shift($array)
        );
    }

}
