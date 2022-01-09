<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Utility\Arr;

trait JoinTest
{

    public function testJoin(): void
    {
        $this->assertSame(
            'a,b,c',
            Arr::join(['a', 'b', 'c'])
        );
    }

    public function testJoinWithSeparator(): void
    {
        $this->assertSame(
            'a-b-c',
            Arr::join(['a', 'b', 'c'], '-')
        );
    }

}
