<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Arr;

trait JoinTest
{

    public function testJoin(): void
    {
        $this->assertEquals(
            'a,b,c',
            Arr::join(['a', 'b', 'c'])
        );
    }

    public function testJoinWithSeparator(): void
    {
        $this->assertEquals(
            'a-b-c',
            Arr::join(['a', 'b', 'c'], '-')
        );
    }

}
