<?php

namespace Source\Interfaces\AccountInterface;

interface AccountValidationInterface 
{
    public function validateAccount(array $account);
    public function mountAccount() : array;
    public function validateFormAccount($data);
}