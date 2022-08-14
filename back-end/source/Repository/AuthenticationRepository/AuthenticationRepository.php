<?php

namespace Source\Repository\AuthenticationRepository;

use Exception;
use Source\Interfaces\AuthenticationInterface\AuthenticationInterface;
use Source\Logs\Logs;
use Source\Model\LegalPersonModel;
use Source\Model\PhysicalPersonModel;
use Source\Utils\FormatExceptionError;
use Source\Utils\LevelLogs;
use Source\Utils\MessageLogs;
use Source\Utils\MessageValidation;

class AuthenticationRepository implements AuthenticationInterface
{
    public function authenticarFields(string $login, string $passowrd)
    {
        $authenticationValidateRepository = new AuthenticationValidateRepository();
        $response = $authenticationValidateRepository->validateFields($login, $passowrd);
        if($response->isValid == false)
        {
            $result = json_encode($response->message);
            throw new Exception($result, 406);
        } else {
            return $response->message;
        }
    }

    public function authenticationPerson(object $person) : string
    {
        if(isset($person->cpf))
        {
            $physicalPerson = new PhysicalPersonModel();
            return $physicalPerson->authenticationPhysicalPerson($person);
        }

        if(isset($person->cnpj))
        {
            $legalPerson = new LegalPersonModel();
            return $legalPerson->authenticationLegalPerson($person);
        }
    }

    public function validPersonPassword(object $person, string $passowrd)
    {
        $verify = password_verify($passowrd,  $person->password);
        if($verify == false)
        {
            $error = FormatExceptionError::exceptionError(MessageValidation::$invalidCredentiais);
            throw new Exception(json_encode($error),406);
        }

        $token = $this->authenticationPerson($person);
        return $token;
    }

    public function login(string $login, string $passowrd)
    {   
        try {
            $credentiais   = $this->authenticarFields($login, $passowrd);
            $accountHolder = (new AuthenticationFindRepository())->findUser($credentiais);
            $token = $this->validPersonPassword($accountHolder->load('address','account'), $credentiais['password']);
            $this->mountAuthenticationLog($accountHolder, MessageValidation::$userLogged, LevelLogs::DEBUG);
            return $token;            
        } catch (Exception $e) {
            
            Logs::logAuthentication(MessageLogs::$errorCreating ,$e->getMessage(), LevelLogs::ERROR);
            return ['message'=>$e->getMessage(), 'code'=>$e->getCode()];
        }
    }

    /**
     * @param $accountHolder
     * @param string $message
     * @param string $level
     * 
     * @return bool
     */
    public function mountAuthenticationLog($accountHolder, $message, string $level) : bool
    {   
        if(!is_null($accountHolder->cpf))
        {
            Logs::logAuthentication($message, $accountHolder->cpf, $level);
        }

        if(!is_null($accountHolder->cnpj))
        {
            Logs::logAuthentication($message, $accountHolder->cnpj, $level);
        }

        return true;
    }

    public function logout()
    {
        //
    }
}