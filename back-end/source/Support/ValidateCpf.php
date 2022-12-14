<?php

namespace Source\Support;

use Source\Model\PhysicalPersonModel;
use Source\Utils\MessageValidation;

class ValidateCpf {

    private $physicalPerson = PhysicalPersonModel::class;

    /**
    * Validate the entered cpf
    * @param string $cpf
    * @return $cpf|string
    */
    public function validarCPF(string $cpf)
    {   
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
        if (strlen($cpf) != 11) {
            return MessageValidation::$invalidCpf;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return MessageValidation::$invalidCpf;
        }

        for ($t = 9; $t < 11; $t++) {

            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return MessageValidation::$invalidCpf;
            }
        }

        return ['message' => 'true', 'response' => $cpf];
    }

    /**
     * checks the existence of a cpf in the database
     * @param int $cpf
     * @return $cpf|null
     */
    public function getCPF(int $cpf)
    {   
        $cpf = $this->physicalPerson::where('cpf','=', $cpf)->first();
        if(!is_null($cpf))
        {
            return MessageValidation::$cpfExists; 
        }

        return true;
    }
}