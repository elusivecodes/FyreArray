<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Utility\Arr;

trait ChunkTest
{

    public function testChunkWithSize(): void
    {
        $this->assertEquals(
            [
                [1, 2],
                [3, 4]
            ],
            Arr::chunk([1, 2, 3, 4], 2)
        );
    }

    public function testChunkWithPreserveKeys(): void
    {
        $this->assertEquals(
            [
                [
                    0 => 1,
                    1 => 2
                ],
                [
                    2 => 3,
                    3 => 4
                ]
            ],
            Arr::chunk([1, 2, 3, 4], 2, true)
        );
    }

    public function testChunkWithEmptyArray(): void
    {
        $this->assertEquals(
            [],
            Arr::chunk([], 2)
        );
    }

}
