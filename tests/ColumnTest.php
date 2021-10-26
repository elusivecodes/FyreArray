<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Utility\Arr;

trait ColumnTest
{

    public function testColumn(): void
    {
        $this->assertEquals(
            [1, 2],
            Arr::column([
                ['a' => 1, 'b' => 2],
                ['a' => 2, 'b' => 3]
            ], 'a')
        );
    }

    public function testColumnMissingValue(): void
    {
        $this->assertEquals(
            [1],
            Arr::column([
                ['a' => 1, 'b' => 2],
                ['b' => 3]
            ], 'a')
        );
    }

    public function testColumnNArgs(): void
    {
        $this->assertEquals(
            [1, 2, 3],
            Arr::column([
                ['a' => 1, 'b' => 2],
                ['a' => 2, 'b' => 3],
                ['a' => 3, 'b' => 4]
            ], 'a')
        );
    }

}
