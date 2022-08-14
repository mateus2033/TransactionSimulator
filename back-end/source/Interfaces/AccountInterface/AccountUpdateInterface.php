<?php

namespace Source\Interfaces\AccountInterface;

use Source\Model\AccountModel;

interface AccountUpdateInterface 
{ 
    public function validateBeforeDeposite($value);
    public function validateBeforeWithdraw(AccountModel $account, $value) : AccountModel;
    public function depositValue($account, $value);
    public function withdrawValue($account, $value); 
    public function validateBeforeTransfer(object $accountHolder, int $accountNumberDestiny);
    public function effectTransfer(object $accountFindRepository, $accountHolder, $value);
    public function manageTransfer(object $accountHolder, int $accountNumberDestiny, float $value) : bool;
}



