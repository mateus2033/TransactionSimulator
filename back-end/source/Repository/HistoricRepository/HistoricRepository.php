<?php

namespace Source\Repository\HistoricRepository;

use Source\Interfaces\HistoricInterface\HistoricInterface;
use Source\Model\HistoricModel;

class HistoricRepository extends HistoricModel implements HistoricInterface
{
    /**
     * return historic action from accoount holder
     * @return object||null 
     */
    public function listHistoric()
    {
    }

    /**
     * @param string $action
     * @param string $message
     * @param object $account
     * @param float  $value
     * @param int||null $number
     * @return bool
     */
    public function storageHistoric(string $action, string $message, object $account, float $value, $number = null): bool
    {
        if (isset($account->cpf)) {
            $person_id = $account->id;
            $this->storageHistoricPhysicalPerson($action,  $message,  $person_id,  $value, $number);
        }

        if (isset($account->cnpj)) {
            $person_id = $account->id;
            $this->storageHistoriLegalPerson($action, $message, $person_id, $value, $number);
        }

        return true;
    }

    /**
     * @param string $action
     * @param string $message
     * @param int    $person_id
     * @param float  $value
     * @param int||null $number
     * @return bool
     */
    public function storageHistoricPhysicalPerson(string $action, string $message, int $person_id, float $value, $number): bool
    {

        if ($number == null) {
            $array = array(
                'action' => $action,
                'message' => $message . ' $' . $value,
                'data' => Date("Ymd"),
                'physical_people_id' => $person_id
            );

            $this->create($array);
            return true;
        }

        $array = array(
            'action' => $action,
            'message' => $message . ' $' . $value . ' ' . 'para' . ' ' . $number,
            'data' => Date("Ymd"),
            'physical_people_id' => $person_id
        );

        $this->create($array);
        return true;
    }

    /**
     * @param string $action
     * @param string $message
     * @param int    $person_id
     * @param float  $value
     * @param int||null $number
     * @return bool
     */
    public function storageHistoriLegalPerson(string $action, string $message, int $person_id, float $value, $number): bool
    {

        if ($number == null) {
            $array = array(
                'action' => $action,
                'message' => $message . ' $' . $value,
                'data' => Date("Ymd"),
                'legal_people_id' => $person_id
            );

            $this->create($array);
            return true;
        }

        $array = array(
            'action' => $action,
            'message' => $message . ' $' . $value . ' ' . 'para' . ' ' . $number,
            'data' => Date("Ymd"),
            'legal_people_id' => $person_id
        );

        $this->create($array);
        return true;
    }
}
