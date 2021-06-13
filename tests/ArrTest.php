<?php
declare(strict_types=1);

namespace Tests;

use
    PHPUnit\Framework\TestCase;

final class ArrTest extends TestCase
{

    use
        ChunkTest,
        CollapseTest,
        ColumnTest,
        CombineTest,
        CountTest,
        DiffTest,
        DivideTest,
        DotTest,
        ExceptTest,
        FillTest,
        FilterTest,
        FindLastTest,
        FindTest,
        FlattenTest,
        ForgetDotTest,
        GetDotTest,
        HasDotTest,
        HasKeyTest,
        IncludesTest,
        IndexTest,
        IndexOfTest,
        IntersectTest,
        IsArrayTest,
        IsListTest,
        JoinTest,
        KeysTest,
        LastIndexOfTest,
        MapTest,
        MergeTest,
        OnlyTest,
        PadTest,
        PluckDotTest,
        PopTest,
        PushTest,
        RandomValueTest,
        RangeTest,
        ReduceTest,
        ReverseTest,
        SetDotTest,
        ShiftTest,
        ShuffleTest,
        SliceTest,
        SortTest,
        SpliceTest,
        UniqueTest,
        UnshiftTest,
        ValuesTest,
        WrapTest;

}
