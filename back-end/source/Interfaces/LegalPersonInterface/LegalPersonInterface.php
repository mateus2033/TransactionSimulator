<?php

namespace Source\Interfaces\LegalPersonInterface;

interface LegalPersonInterface
{
    public function checkAccounLegal(array $data);
    public function checkRelations(array $accountLegal, $address_id, int $account_id = null);
    public function storageAddress(array $address); 
    public function storageAccount(array $account);
    public function storageLegalAccount(array $accountLegal);
}