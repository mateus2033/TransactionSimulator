<?php

namespace Source\Repository\AccountRepository;

use Source\Interfaces\AccountInterface\AccountValidationInterface;
use Source\Model\AccountModel;
use Source\Support\GenerateNumber;
use Source\Utils\MessageValidation;

class AccountValidateRepository extends AccountModel implements AccountValidationInterface {

    public array $message;
    public bool $isValid;

    public function validateAccount(array $account) 
    {  
        $this->validateFormAccount($account);
        if ($this->isValid) {
            return $this->mountAccount();
        } else {
            return $this;
        }
    }

    public function mountAccount() : array
    {
        $array = array(
            'value' => $this->getValue(),
            'number' => $this->getNumber(),
        );
        
        return $array;
    }

    public function validateFormAccount($data)
    {   
       
        $array = [];
        $array['value']  = $this->_value($data);
        $array['number'] = $this->_number();
       
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
     * Valida o campo $value
     * @return string|null
     */
    private function _value($data)
    {   
        if(!isset($data['value']))
        {
            return MessageValidation::$required;
        }

        $data['value'] = (float) $data['value'];

        if(!is_float($data['value']))
        {
            return MessageValidation::$onlyFloat;
        }
        
        $this->setValue($data['value']);
        return null;
    }

    /**
     * Valida o campo $number
     * @return string|null
     */
    private function _number()
    {
        $number = (new GenerateNumber())->generateNumber();
        $this->setNumber($number);
        return null;
    }

}