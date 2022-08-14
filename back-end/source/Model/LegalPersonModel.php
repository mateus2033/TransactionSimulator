<?php

namespace Source\Model;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Database\Eloquent\Model;

class LegalPersonModel extends Model
{
    protected $table = 'legal_persons';
    protected $fillable = ['name', 'cnpj', 'password', 'stateRegistration', 'foundationDate', 'cellphone', 'account_id', 'address_id'];

    private string $name;
    private string $cnpj;
    private string $password;
    private string $stateRegistration;
    private string $foundationDate;
    private string $cellphone;
    private int $account_id;
    private int $address_id;

    public function getName()
    {
        return $this->name;
    }

    public function getCnpj()
    {
        return $this->cnpj;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getStateRegistration()
    {
        return $this->stateRegistration;
    }

    public function getFoundationDate()
    {
        return $this->foundationDate;
    }

    public function getCellphone()
    {
        return $this->cellphone;
    }

    public function getAccount_id()
    {
        return $this->account_id;
    }

    public function getAddress_id()
    {
        return $this->address_id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setStateRegistration($stateRegistration)
    {
        $this->stateRegistration = $stateRegistration;
    }

    public function setFoundationDate($foundationDate)
    {
        $this->foundationDate = $foundationDate;
    }

    public function setCellphone($cellphone)
    {
        $this->cellphone = $cellphone;
    }

    public function setAccount_id($account_id)
    {
        $this->account_id = $account_id;
    }

    public function setAddress_id($address_id)
    {
        $this->address_id = $address_id;
    }

    public function address()
    {
        return $this->belongsTo(AddressModel::class, 'address_id');
    }

    public function account()
    {
        return $this->belongsTo(AccountModel::class, 'account_id');
    }

    public function historic()
    {
        return $this->hasMany(HistoricModel::class, 'legal_people_id');
    }

    public function authenticationLegalPerson(LegalPersonModel $legalPerson)
    {
        $key = 'example_key';
        $payload = [
            'iat' => 1356999524,
            'nbf' => 1357000000,
            'id'                => $legalPerson['id'],
            'name'              => $legalPerson['name'],
            'cnpj'              => $legalPerson['cnpj'],
            'stateRegistration' => $legalPerson['stateRegistration'],
            'foundationDate' => $legalPerson['foundationDate'],
            'cellphone'      => $legalPerson['cellphone'],
            'address' => [
                'street' => $legalPerson->address->street,
                'number' => $legalPerson->address->number,
                'cep'    => $legalPerson->address->cep,
                'city'   => $legalPerson->address->city,
                'uf'     => $legalPerson->address->uf
            ],
            'account' => [
                'id'    => $legalPerson->account->id,
                'number'=> $legalPerson->account->number,
                'value' => $legalPerson->account->value,
            ]
        ];

        JWT::$leeway = 10;
        $jwt = JWT::encode($payload, $key, 'HS256');
        return $jwt;
    }
}
