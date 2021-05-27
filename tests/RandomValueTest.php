<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait RandomValueTest
{

    public function testRandomValue(): void
    {
        $array = [1, 2, 3];
        $this->assertTrue(
            Arr::includes($array, Arr::randomValue($array))
        );
    }

    public function testRandomValueIsRandom(): void
    {
        $array = [1, 2, 3];
        $test = [];
        for ($i = 0; $i < 100; $i++) {
            $test[] = Arr::randomValue($array);
        }
        $test = Arr::unique($test);
        $this->assertEquals(
            3,
            Arr::count($test)
        );
    }

}
