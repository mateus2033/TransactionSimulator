<?php

namespace Source\Interfaces\PhysicalPersonInterface;

interface PhysicalPersonInterface
{
    public function checkAccounPhysical(array $data);
    public function checkRelations(array $accountPhysical, $address_id, int $account_id = null) : array;
    public function storagePhysicalAccount(array $accountPhysical);
    public function storageAddress(array $address) : int;
    public function storageAccount(array $account) : int;
}