<?php

namespace Source\Interfaces\AccountInterface;

interface AccountInterface
{
    public function checkAccount(array $account);
    public function createAccount(array $account) : int;
    public function mountAccountLog($account, string $message, string $level) : bool;
}