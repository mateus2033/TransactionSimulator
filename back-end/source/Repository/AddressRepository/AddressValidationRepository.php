<?php

namespace Source\Repository\AddressRepository;

use Source\Interfaces\AddreesInterface\AddressValidationInterface;
use Source\Model\AddressModel;
use Source\Support\ValidateCep;
use Source\Support\ValidateUf;
use Source\Utils\MessageValidation;

/**
 *@property bool $isValid
 *@property string[] $message
 */
class AddressValidationRepository extends AddressModel implements AddressValidationInterface
{

    public array $message;
    public bool $isValid;

    public function validateAddress(array $address)
    {
        $this->validateFormAddress($address);

        if ($this->isValid) {
            return $this->mountAddress();
        } else {
            return $this;
        }
    }

    public function mountAddress() : array 
    {
        $array = array(
            'street' => $this->getStreet(),
            'number' => $this->getNumber(),
            'cep'    => $this->getCep(),
            'city'   => $this->getCity(),
            'uf'     => $this->getUf(),
        );

        return $array;
    }

    public function validateFormAddress($data)
    {   
       
        $array = [];
        $array['street'] = $this->_street($data);
        $array['number'] = $this->_number($data);
        $array['cep']    = $this->_cep($data);
        $array['city']   = $this->_city($data);
        $array['uf']     = $this->_uf($data);

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
     * valida o campo street
     * @param array $data
     * @return string|null
    */
    private function _street($data)
    {
        if(!isset($data['street']))
        {
            return MessageValidation::$required;
        }

        if(!is_string($data['street']))
        {
            return MessageValidation::$onlyString;
        }

        $this->setStreet($data['street']);
        return null;
    }

    /**
     * valida o campo number
     * @param array $data
     * @return string|null
    */
    private function _number($data)
    {
        if(!isset($data['number']))
        {
            return MessageValidation::$required;
        }

        if(!is_string($data['number']))
        {
            return MessageValidation::$onlyString;
        }

        $this->setNumber($data['number']);
        return null;
    }

    /**
     * valida o campo cep
     * @param array $data
     * @return string|null
    */
    private function _cep($data)
    {
        if(!isset($data['cep']))
        {
            return MessageValidation::$required;
        }

        if(!is_string($data['cep']))
        {
            return MessageValidation::$onlyString;
        }

        $cep = (new ValidateCep())->validarCep($data['cep']);
        if(is_string($cep))
        {
            return $cep;
        }
        
        $this->setCep($data['cep']);
        return null;
    }

    /**
     * valida o campo city
     * @param array $data
     * @return string|null
    */
    private function _city($data)
    {
        if(!isset($data['city']))
        {
            return MessageValidation::$required;
        }

        if(!is_string($data['city']))
        {
            return MessageValidation::$onlyString;
        }

        $this->setCity($data['city']);
        return null;
    }

    /**
     * valida o campo uf
     * @param array $data
     * @return string|null
    */
    private function _uf($data)
    {
        if(!isset($data['uf']))
        {
            return MessageValidation::$required;
        }

        if(!is_string($data['uf']))
        {
            return MessageValidation::$onlyString;
        }

        $uf = (new ValidateUf())->validarUf($data['uf']);
        if(is_string($uf)){
            return $uf;
        }

        $this->setUf($data['uf']);
        return null;
    }

    /**
     * valida o accountHolder_id
     * @param array $data
     * @return string|null
    */
    private function _accountHolder_id($accountHolder_id)
    {
        if(!isset($accountHolder_id))
        {
            return MessageValidation::$required;
        }

        if(!is_integer($accountHolder_id))
        {
            return MessageValidation::$onlyInteger;
        }
       
        $this->setAccountholder_id($accountHolder_id);
        return null;
    }
}
