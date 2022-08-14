<?php

namespace Source\Repository\AuthenticationRepository;

use Exception;
use Source\Interfaces\AuthenticationInterface\AuthenticationFindInterface;
use Source\Model\LegalPersonModel;
use Source\Model\PhysicalPersonModel;
use Source\Utils\FormatExceptionError;
use Source\Utils\MessageValidation;

class AuthenticationFindRepository implements AuthenticationFindInterface
{
    private $legalPerson    = LegalPersonModel::class;
    private $physicalPerson = PhysicalPersonModel::class;
    
    public function findUser($credentiais) 
    {
        if(isset($credentiais['cpf']))
        {
            return $this->findAccountHolderByCpf($credentiais['cpf']);
        }

        if(isset($credentiais['cnpj']))
        {
            return $this->findAccountHolderByCnpj($credentiais['cnpj']);
        }

        return false;
    }

    public function findAccountHolderByCpf(string $cpf)
    {
        $accountHolder = $this->physicalPerson::where('cpf' ,'=', $cpf)->first();
        if(is_null($accountHolder))
        {
            $error = FormatExceptionError::exceptionError(MessageValidation::$userDoesNotExist);
            throw new Exception(json_encode($error),406);
        }
        
        return $accountHolder;
    }

    public function findAccountHolderByCnpj(string $cnpj)
    {
        $accountHolder = $this->legalPerson::where('cnpj' ,'=', $cnpj)->first();
        if(is_null($accountHolder))
        {
            $error = FormatExceptionError::exceptionError(MessageValidation::$userDoesNotExist);
            throw new Exception(json_encode($error),406);
        }

        return $accountHolder;
    }
}