<?php

declare(strict_types=1);

namespace AndKom\Rand48\Tests;

use AndKom\Rand48\Rand48;
use PHPUnit\Framework\TestCase;

class Rand48Test extends TestCase
{
    public function testGenerate()
    {
        $rng = new Rand48(1538857073237);
        $this->assertEquals($rng->random(), 0.6400923397828205);
        $this->assertEquals($rng->random(), 0.20170841895667824);
        $this->assertEquals($rng->random(), 0.19708366795806354);
        $this->assertEquals($rng->random(), 0.7711449869389728);
        $this->assertEquals($rng->random(), 0.7308651738682106);
    }
}