<?php

namespace Source\Repository\PersonRepository;

use Exception;
use Source\Interfaces\PersonInterface\PersonFindInterface;
use Source\Model\LegalPersonModel;
use Source\Model\PhysicalPersonModel;
use Source\Utils\FormatExceptionError;
use Source\Utils\MessageValidation;

class PersonFindRepository implements PersonFindInterface
{
    private $physicalPerson = PhysicalPersonModel::class;
    private $legalPerson    = LegalPersonModel::class;
    
    public function validateUser($user) : array
    {
        $personValidRepository = new PersonValidRepository();
        $response = $personValidRepository->validateUser($user);
        return $response;
    }

    public function findUser($user) 
    {
        $user = $this->validateUser($user);

        if($user['type'] == 'cpf')
        {
            return $this->findPhysicalPeople($user['user']);
        }

        if($user['type'] == 'cnpj')
        {
            return $this->findLegalPeople($user['user']);
        }

        return false;
    }

    public function findPhysicalPeople(string $cpf)
    {   
        $user = $this->physicalPerson::where('cpf' ,'=', $cpf)->first();
        if(is_null($user))
        {
            $error = FormatExceptionError::exceptionError(MessageValidation::$userDoesNotExist);
            throw new Exception(json_encode($error),406);
        }
        
        return $user;
    }

    public function findLegalPeople(string $cnpj)
    {
        $user = $this->legalPerson::where('cnpj' ,'=', $cnpj)->first();
        if(is_null($user))
        {
            $error = FormatExceptionError::exceptionError(MessageValidation::$userDoesNotExist);
            throw new Exception(json_encode($error),406);
        }

        return $user;
    }
}