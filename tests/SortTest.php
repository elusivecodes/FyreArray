<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait SortTest
{

    public function testSort(): void
    {
        $this->assertEquals(
            ['Item 1', 'Item 10', 'Item 11', 'Item 100', 'Item 101'],
            Arr::sort(['Item 101', 'Item 10', 'Item 1', 'Item 11', 'Item 100'])
        );
    }

    public function testSortFlag(): void
    {
        $this->assertEquals(
            [1, 1.25, 1.5, 1.75, 2],
            Arr::sort([1.5, 1.25, 2, 1.75, 1], Arr::SORT_NUMERIC)
        );
    }

    public function testSortCallback(): void
    {
        $this->assertEquals(
            [1, 1.25, 1.5, 1.75, 2],
            Arr::sort([1.5, 1.25, 2, 1.75, 1], fn($a, $b) => $a < $b ? -1 : 1)
        );
    }

}
