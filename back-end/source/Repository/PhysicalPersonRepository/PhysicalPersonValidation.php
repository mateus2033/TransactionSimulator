<?php

namespace Source\Repository\PhysicalPersonRepository;

use Source\Interfaces\PhysicalPersonInterface\PhysicalPersonValidationInterface;
use Source\Model\PhysicalPersonModel;
use Source\Support\ValidateCnpj;
use Source\Support\ValidateCpf;
use Source\Support\ValidateDate;
use Source\Utils\MessageValidation;

class PhysicalPersonValidation extends PhysicalPersonModel implements PhysicalPersonValidationInterface
{

    public array $message;
    public bool  $isValid;

    public function validateAccountHolder(array $data)
    {
        $this->validateFormAccountPhysic($data);

        if ($this->isValid) {
            return $this->mountAccountPhysic();
        } else {
            return $this;
        }
    }

    public function mountAccountPhysic()
    {
        $array = array(
            'name' => $this->getName(),
            'cpf'  => $this->getCpf(),
            'password' => $this->getPassword(),
            'rg'   => $this->getRg(),
            'birthDate'         => $this->getBirthDate(),
            'cellphone'         => $this->getCellphone(),
            'address_id'        => $this->getAddress_id(),
            'account_id'        => $this->getAccount_id()
        );

        return $array;
    }

    public function validateFormAccountPhysic($data) 
    {
        $array = [];
        $array['name']  = $this->_name($data);
        $array['cpf']   = $this->_cpf($data);
        $array['password'] = $this->_password($data);
        $array['rg']    = $this->_rg($data);
        $array['birthDate']        = $this->_birthDate($data);
        $array['cellphone']        = $this->_cellphone($data);
        $array['address_id']       = $this->_address_id($data);
        $array['account_id']       = $this->_account_id($data);

        $array =  array_filter($array, function ($data) {
            return $data != null;
        });

        $state = !empty($array);

        if ($state) {
            $this->message = $array;
            $this->isValid    = false;
        } else {

            $this->message = [];
            $this->isValid = true;
        }
    }

      /**
     * validate the name field
     * @param array $data
     * @return string|null
     */
    private function _name($data)
    {
        if (!isset($data['name'])) {
            return MessageValidation::$required;
        }

        if (!is_string($data['name'])) {
            return MessageValidation::$onlyString;
        }

        $this->setName($data['name']);
        return null;
    }

    /**
     * validate the cpf field
     * @param array $data
     * @return string|null
     */
    private function _cpf($data)
    {
        if (is_null($data['cpf'])) {
            return null;
        }

        if (!is_string($data['cpf'])) {
            return MessageValidation::$onlyString;
        }

        $validateCpf = new ValidateCpf();
        $cpf = $validateCpf->validarCPF($data['cpf']);
        
        if (!is_array($cpf)) {
            return $cpf;
        }

        $getCPF = $validateCpf->getCPF($cpf['response']);
         if(is_string($getCPF)){
            return $getCPF;
        }

        $this->setCpf($cpf['response']);
        return null;
    }

    /**
     * validate the password field
     * @param array $data
     * @return string|null
     */
    private function _password($data)
    {
        if (is_null($data['password'])) {       
            return MessageValidation::$required;
        }

        if (!is_string($data['password'])) {       
            return MessageValidation::$onlyString;
        }

        $caracterNumber = strlen($data['password']);
        if($caracterNumber < 3 ){
            return MessageValidation::$minRequired;
        }

       $password =  password_hash($data['password'], PASSWORD_DEFAULT);
       $this->setPassword($password);
       return null;
    }

    /**
     * validate the rg field
     * @param array $data
     * @return string|null
     */
    private function _rg($data)
    {
        if (!isset($data['rg'])) {
            return MessageValidation::$required;
        }

        if (!is_string($data['rg'])) {
            return MessageValidation::$onlyString;
        }

        $this->setRg($data['rg']);
        return null;
    }

    /**
     * validate the birthDate field
     * @param array $data
     * @return string|null
     */
    private function _birthDate($data)
    {
        if (!isset($data['birthDate'])) {
            return MessageValidation::$required;
        }

        $birthDate = (new ValidateDate())->validaData($data['birthDate']);
        if (is_string($birthDate)) {
            return $birthDate;
        }

        $this->setBirthDate($data['birthDate']);
        return null;
    }

    /**
     * validate the cellphone field
     * @param array $data
     * @return string|null
     */
    private function _cellphone($data)
    {
        if (!isset($data['cellphone'])) {
            return MessageValidation::$required;
        }

        $this->setCellphone($data['cellphone']);
        return null;
    }

    /**
     * validate the address_id field
     * @param array $data
     * @return string|null
     */
    private function _address_id($data)
    {
        if (!isset($data['address_id'])) {
            return MessageValidation::$required;
        }

        if(!is_integer($data['address_id'])){
            return MessageValidation::$onlyInteger;
        }

        $this->setAddress_id($data['address_id']);
        return null;
    }

    /**
     * validate the account_id field
     * @param array $data
     * @return string|null
     */
    private function _account_id($data)
    {
        if (!isset($data['account_id'])) {
            return MessageValidation::$required;
        }

        if(!is_integer($data['account_id'])){
            return MessageValidation::$onlyInteger;
        }

        $this->setAccount_id($data['account_id']);
        return null;
    }
}