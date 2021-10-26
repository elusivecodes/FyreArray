<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Utility\Arr;

trait IsListTest
{

    public function testIsListNumeric(): void
    {
        $this->assertTrue(
            Arr::isList([1, 2, 3])
        );
    }

    public function testIsListAssociative(): void
    {
        $this->assertFalse(
            Arr::isList(['a' => 1, 'b' => 2, 'c' => 3])
        );
    }

    public function testIsListMixed(): void
    {
        $this->assertFalse(
            Arr::isList(['a' => 1, 2, 'c' => 3])
        );
    }

    public function testIsListGaps(): void
    {
        $this->assertFalse(
            Arr::isList([0 => 1, 2 => 3])
        );
    }

    public function testIsListOrder(): void
    {
        $this->assertFalse(
            Arr::isList([1 => 0, 0 => 2])
        );
    }

    public function testIsListNegative(): void
    {
        $this->assertFalse(
            Arr::isList([-1 => 0, 0 => 1])
        );
    }

    public function testIsListEmpty(): void
    {
        $this->assertTrue(
            Arr::isList([])
        );
    }

}
