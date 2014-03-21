<?php

class ChocolateFeastTest extends PHPUnit_Framework_TestCase
{
    private $chocolateFeast;
    const DEFAULT_PRICE = 5;
    const DEFAULT_ENVELOPES_PER_FREE_UNIT = 20;

    public function setUp()
    {
        $this->chocolateFeast = new ChocolateFeast();
    }

    public function testDontHaveEnoughMoney()
    {
        $this->assertSame(0, $this->chocolateFeast->eat(0, self::DEFAULT_PRICE, self::DEFAULT_ENVELOPES_PER_FREE_UNIT));
    }

//    public function testWithFreeChocolates()
//    {
//        $this->assertSame(, $this->chocolateFeast->eat(5, 0, self::DEFAULT_ENVELOPES_PER_FREE_UNIT));
//    }

    public function testHaveEnoughMoneyButNoRemainder()
    {
        $this->assertSame(1, $this->chocolateFeast->eat(5, self::DEFAULT_PRICE, self::DEFAULT_ENVELOPES_PER_FREE_UNIT));
    }
    
    public function testHaveEnoughMoneyButRemainder()
    {
        $this->assertSame(2, $this->chocolateFeast->eat(12, self::DEFAULT_PRICE, self::DEFAULT_ENVELOPES_PER_FREE_UNIT));
    }

    public function testGettingAnExtraChocolate()
    {
        $this->assertSame(21, $this->chocolateFeast->eat(100, self::DEFAULT_PRICE, self::DEFAULT_ENVELOPES_PER_FREE_UNIT));
    }

    public function testEatGettingExtraChocolatesAndExchangingEnvelopesAgain()
    {
        $this->assertSame(5, $this->chocolateFeast->eat(6, 2, 2));
    }
}

