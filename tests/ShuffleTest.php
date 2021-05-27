<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

use function sort;

trait ShuffleTest
{

    public function testShuffleIsRandom(): void
    {
        $array = Arr::range(1, 10);
        $arrays = [];

        for ($i = 0; $i < 1000; $i++) {
            $shuffled = Arr::shuffle($array);
            $sorted = Arr::sort($shuffled, Arr::SORT_NUMERIC);
            $this->assertEquals($array, $sorted);
            $arrays[] = Arr::join($shuffled);
        }

        $arrays = Arr::unique($arrays);

        $this->assertTrue(
            Arr::count($arrays) > 100
        );
    }

}
