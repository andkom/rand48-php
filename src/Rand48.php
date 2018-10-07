<?php

declare(strict_types=1);

namespace AndKom\Rand48;

/**
 * Class Rand48
 * @package AndKom\Rand48
 */
class Rand48
{
    const A_HI = 0x5DE;
    const A_LO = 0xECE66D;
    const B = 0x0B;
    const MAX_HALF = 0x1000000;

    /**
     * @var int
     */
    protected $stateLo;

    /**
     * @var int
     */
    protected $stateHi;

    /**
     * Rand48 constructor.
     * @param int|null $seed
     */
    public function __construct(int $seed = null)
    {
        if (!$seed) {
            $seed = time();
        }

        $this->init($seed);
    }

    /**
     * @return Rand48
     */
    protected function nextState(): self
    {
        $tmpLo = $this->stateLo * static::A_LO + static::B;
        $tmpHi = $this->stateLo * static::A_HI + $this->stateHi * static::A_LO;

        if ($tmpLo >= static::MAX_HALF) {
            $carry = floor($tmpLo / static::MAX_HALF);

            $tmpHi = $tmpHi + $carry;
            $tmpLo = $tmpLo % static::MAX_HALF;
        }

        $tmpHi = $tmpHi % static::MAX_HALF;

        $this->stateLo = $tmpLo;
        $this->stateHi = $tmpHi;

        return $this;
    }

    /**
     * @param int $seed
     * @return Rand48
     */
    public function init(int $seed): self
    {
        $seedHi = floor($seed / static::MAX_HALF);
        $seedLo = $seed % static::MAX_HALF;

        $this->stateLo = $seedLo ^ static::A_LO;
        $this->stateHi = $seedHi ^ static::A_HI;

        return $this;
    }

    /**
     * @return float
     */
    public function random(): float
    {
        $this->nextState();

        $first = ($this->stateHi * 4) + floor($this->stateLo / 0x400000);

        $this->nextState();

        $second = ($this->stateHi * 8) + floor($this->stateLo / 0x200000);

        $num = $first * 0x8000000 + $second;
        $res = $num / pow(2, 53);

        return $res;
    }
}