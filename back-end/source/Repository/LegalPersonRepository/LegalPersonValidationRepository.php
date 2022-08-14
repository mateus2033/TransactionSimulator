<?php

namespace Source\Repository\LegalPersonRepository;

use Source\Interfaces\LegalPersonInterface\LegalPersonValidationInterface;
use Source\Model\LegalPersonModel;
use Source\Support\ValidateCnpj;
use Source\Support\ValidateDate;
use Source\Utils\MessageValidation;

class LegalPersonValidationRepository extends LegalPersonModel implements LegalPersonValidationInterface
{
    public array $message;
    public bool  $isValid;

    public function validateLegalPerson(array $legalPeople)
    {
        $this->validateFormAccountLegal($legalPeople);
        if ($this->isValid) {
            return $this->mountAccountLegal();
        } else {
            return $this;
        }
    }

    public function mountAccountLegal() : array
    {
        $array = array(
            'name' => $this->getName(),          
            'cnpj' => $this->getCnpj(),
            'password' => $this->getPassword(),           
            'stateRegistration' => $this->getStateRegistration(),          
            'foundationDate'    => $this->getFoundationDate(),
            'cellphone'         => $this->getCellphone()
        );

        return $array;
    }

    public function validateFormAccountLegal($data) 
    {
        $array = [];
        $array['name']     = $this->_name($data);
        $array['cnpj']     = $this->_cnpj($data);
        $array['password'] = $this->_password($data);
        $array['stateRegistration'] = $this->_stateRegistration($data);
        $array['foundationDate']    = $this->_foundationDate($data);
        $array['cellphone']         = $this->_cellphone($data);

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
     * validate the cnpj field
     * @param array $data
     * @return string|null
     */
    private function _cnpj($data)
    {
        if (is_null($data['cnpj'])) {       
            return null;
        }

        if (!is_string($data['cnpj'])) {
            return MessageValidation::$onlyString;
        }

        $validateCnpj = new ValidateCnpj();
        $cnpj = $validateCnpj->validarCnpj($data['cnpj']);
        if (!is_array($cnpj)) {
            return $cnpj;
        }

        $getCnpj = $validateCnpj->getCnpj($cnpj['response']);
        if(is_string($getCnpj)){
            return $getCnpj;
        }

        $this->setCnpj($cnpj['response']);
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
     * validate the stateRegistration field
     * @param array $data
     * @return string|null
     */
    private function _stateRegistration($data)
    {

        if (!isset($data['stateRegistration'])) {
            return MessageValidation::$required;
        }

        if (!is_string($data['stateRegistration'])) {
            return MessageValidation::$onlyString;
        }

        $this->setStateRegistration($data['stateRegistration']);

        return null;
    }

    /**
     * validate the foundationDate field
     * @param array $data
     * @return string|null
     */
    private function _foundationDate($data)
    {
        if (!isset($data['foundationDate'])) {
            return MessageValidation::$required;
        }

        $foundationDate = (new ValidateDate())->validaData($data['foundationDate']);
        if (is_string($foundationDate)) {
            return $foundationDate;
        }

        $this->setFoundationDate($data['foundationDate']);
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
    }
}
