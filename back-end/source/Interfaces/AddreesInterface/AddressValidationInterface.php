<?php

namespace Source\Interfaces\AddreesInterface;

interface AddressValidationInterface 
{
    public function validateAddress(array $address);
    public function mountAddress() : array;
    public function validateFormAddress($data);
}