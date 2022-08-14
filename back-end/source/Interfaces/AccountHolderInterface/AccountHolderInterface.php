<?php

namespace Source\Interfaces\AccountHolderInterface;


interface AccountHolderInterface 
{  
    public function historicList($user);
    public function accountHolderList($user);
    public function accountDeposit(string $user, $value);
    public function accountWithdraw(string $user,  $value);
    public function accountTransfer(string $user, int $numberAccount, float $value);
    public function mountAccountHolderLog($accountHolder, $message, string $level): bool;
    public function invalidToken();
}