<?php

namespace Source\Repository\PersonRepository;

use Exception;
use Source\Support\ValidateCnpj;
use Source\Support\ValidateCpf;
use Source\Utils\FormatExceptionError;
use Source\Utils\MessageValidation;

class PersonValidRepository 
{
    public array  $message;
    public bool   $isValid;
    public $type;

    public function validateUser(string $user) : array
    {
        $response = $this->validateFormAccountHoulder($user);
        return $response;
    }

    public function validateFormAccountHoulder(string $user) 
    {
        $user = $this->_user($user);
        $response = $this->_validateStateArray($user);
        return $response;
    }

    private function _validateStateArray($user)  : array
    {   
        $array = [];

        if($this->type == 'cnpj')
        {
            $array['type'] = 'cnpj';
            $array['user'] = $user;
        }

        if($this->type == 'cpf')
        {
            $array['type'] = 'cpf';
            $array['user'] = $user;
        }

        return $array;
    }

    /**
     * validate the field login
     * @param string $login
     * @return string|null
     */
    private function _user(string $login) : string
    {
        $count = strlen($login);
        if($count == 0)
        {
            $error = FormatExceptionError::exceptionError(MessageValidation::$required);
            throw new Exception(json_encode($error), 406);
        }

        if(!is_string($login))
        {
            $error = FormatExceptionError::exceptionError(MessageValidation::$onlyString);
            throw new Exception(json_encode($error), 406);
        }

        if($count == 14) 
        {
           return $this->validLoginCpf($login);   
        }

        if($count == 18)
        {
            return $this->validLoginCnpj($login);
        }

        $error = FormatExceptionError::exceptionError(MessageValidation::$invalidLogin);
        throw new Exception(json_encode($error), 406);
    }

    /**
     * Validates the state of the user field
     * @param string $user
     * @return string
     */
    private function validLoginCpf(string $user) : string
    {   
        $cpf = (new ValidateCpf())->validarCPF($user);
        if(isset($cpf['message']))
        {
            $this->type = "cpf";
            return $cpf['response'];
        }
        
        $error = FormatExceptionError::exceptionError($cpf);
        throw new Exception(json_encode($error), 406);
    }

    /**
     * Validate the state of the user field
     * @param string $user
     * @return string
     */
    private function validLoginCnpj(string $user) : string
    {
        $cnpj = (new ValidateCnpj())->validarCnpj($user);
        if(isset($cnpj['message']))
        {
            $this->type = 'cnpj';
            return $cnpj['response'];
        }
         
        $error = FormatExceptionError::exceptionError($cnpj);
        throw new Exception(json_encode($error), 406);
    }
}