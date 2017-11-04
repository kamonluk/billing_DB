<?php namespace MainDriver;

use Operation\Transfer;

final class MainDriver {
    public function transfer(string $srcNumber,string $srcName,string $desNumber,int $amount): void { 
        $transfer = new Transfer($srcNumber, $srcName);
        $transfer->doTransfer($desNumber, $amount);
    }
}