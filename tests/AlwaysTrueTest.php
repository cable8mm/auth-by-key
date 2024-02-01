<?php

namespace Cable8mm\AuthByKey\Tests;

use PHPUnit\Framework\TestCase;

final class AlwaysTrueTest extends TestCase
{
    public function test_always_true()
    {
        $this->assertTrue(true);
    }
}
