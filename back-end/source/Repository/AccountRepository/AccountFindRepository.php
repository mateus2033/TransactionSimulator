<?php

namespace Source\Repository\AccountRepository;

use Exception;
use Source\Interfaces\AccountInterface\AccountFindInterface;
use Source\Model\AccountModel;
use Source\Utils\FormatExceptionError;
use Source\Utils\MessageValidation;

class AccountFindRepository extends AccountModel implements AccountFindInterface
{
    private $accountModelClass = AccountModel::class;

    public function findAccountByNumber(int $number)
    {
        $account = $this->accountModelClass::where('number' ,'=', $number)->first();   
        if(is_null($account)){
            $error = FormatExceptionError::exceptionError(MessageValidation::$accountNotExists);
            throw new Exception(json_encode($error) ,404);
        }
        return $account;
    }
}