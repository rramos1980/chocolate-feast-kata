<?php
class ChocolateFeast
{
    public function eat($moneyAvailable, $pricePerChocolateUnit, $envelopesPerFreeUnit)
    {
        $this->guardFromFreeChocolates($pricePerChocolateUnit);
        $this->guardFromOneEnvelopeOneChocolateExchange($envelopesPerFreeUnit);

        $chocolateBought = $this->buyChocolate($moneyAvailable, $pricePerChocolateUnit);
        $freeChocolate = $this->getSomeFreeChocolate($chocolateBought, $envelopesPerFreeUnit);
        return (int) $chocolateBought + (int) $freeChocolate;
    }

    private function guardFromFreeChocolates($pricePerChocolateUnit)
    {
        if ($pricePerChocolateUnit <= 0) {
           throw new ChocolateFeastException('It is not possible to have FREE chocolate!');
        }
    }

    private function guardFromOneEnvelopeOneChocolateExchange($envelopesPerFreeUnit)
    {
        if ($envelopesPerFreeUnit <= 1) {
            throw new ChocolateFeastException('You cannot exchange one chocolate for one envelope!');
        }
    }

    private function buyChocolate($moneyAvailable, $pricePerChocolateUnit)
    {
        return (int)($moneyAvailable / $pricePerChocolateUnit);
    }

    private function getSomeFreeChocolate($envelopesAvailable, $envelopesPerFreeUnit)
    {
        $totalFreeChocolate = 0;

        do {
            $freeChocolate = $this->exchangeEnvelopesForChocolate($envelopesAvailable, $envelopesPerFreeUnit);
            $envelopesAvailable = $this->computeRemainingEnvelopesFromExchange(
                $envelopesAvailable,
                $envelopesPerFreeUnit
            );
            $envelopesAvailable += $freeChocolate;
            $totalFreeChocolate += $freeChocolate;
        } while ($envelopesAvailable >= $envelopesPerFreeUnit);

        return $totalFreeChocolate;
    }


    private function exchangeEnvelopesForChocolate($envelopesAvailable, $envelopesPerFreeUnit)
    {
        return (int)($envelopesAvailable / $envelopesPerFreeUnit);
    }

    private function computeRemainingEnvelopesFromExchange($envelopesAvailable, $envelopesPerFreeUnit)
    {
        return $envelopesAvailable % $envelopesPerFreeUnit;
    }
}

