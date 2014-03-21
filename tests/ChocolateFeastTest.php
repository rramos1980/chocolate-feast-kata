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

    /**
     * @test
     */
    public function dontHaveEnoughMoney()
    {
        $this->assertSame(0, $this->chocolateFeast->eat(0, self::DEFAULT_PRICE, self::DEFAULT_ENVELOPES_PER_FREE_UNIT));
    }

    /**
     * @test
     */
    public function haveEnoughMoneyButNoRemainder()
    {
        $this->assertSame(1, $this->chocolateFeast->eat(5, self::DEFAULT_PRICE, self::DEFAULT_ENVELOPES_PER_FREE_UNIT));
    }

    /**
     * @test
     */
    public function haveEnoughMoneyButRemainder()
    {
        $this->assertSame(2, $this->chocolateFeast->eat(12, self::DEFAULT_PRICE, self::DEFAULT_ENVELOPES_PER_FREE_UNIT));
    }

    /**
     * @test
     */
    public function gettingAnExtraChocolate()
    {
        $this->assertSame(21, $this->chocolateFeast->eat(100, self::DEFAULT_PRICE, self::DEFAULT_ENVELOPES_PER_FREE_UNIT));
    }

    /**
     * @test
     */
    public function gettingExtraChocolatesAndExchangingEnvelopesAgain()
    {
        $this->assertSame(5, $this->chocolateFeast->eat(6, 2, 2));
    }

    /**
     * @test
     * @expectedException ChocolateFeastException
     */
    public function cannotEatWithFreeChocolates()
    {
        $this->chocolateFeast->eat(5, 0, self::DEFAULT_ENVELOPES_PER_FREE_UNIT);
    }

    /**
     * @test
     * @expectedException ChocolateFeastException
     */
    public function cannotChangeOneEnvelopeForOneChocolate()
    {
        $this->chocolateFeast->eat(5, 5, 1);
    }

}

