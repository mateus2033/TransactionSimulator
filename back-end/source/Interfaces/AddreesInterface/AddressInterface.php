<?php

namespace Source\Interfaces\AddreesInterface;

interface AddressInterface 
{ 
    public function mountAddressLog($address, string $message, string $level) : bool;
    public function checkAddress(array $address);
    public function storageAddress($address) : int;
}