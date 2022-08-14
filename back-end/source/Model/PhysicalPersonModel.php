<?php

namespace Source\Model;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Database\Eloquent\Model;

class PhysicalPersonModel extends Model
{
    protected $table = 'physical_persons';
    protected $fillable = ['name', 'cpf', 'password', 'rg', 'birthDate', 'cellphone', 'account_id', 'address_id'];

    private string $name;
    private string $cpf;
    private string $password;
    private string $rg;
    private string $birthDate;
    private string $cellphone;
    private $account_id;
    private $address_id;

    public function getName()
    {
        return $this->name;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRg()
    {
        return $this->rg;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
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

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setRg($rg)
    {
        $this->rg = $rg;
    }

    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
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
        return $this->hasMany(HistoricModel::class, 'physical_people_id');
    }

    public function authenticationPhysicalPerson(PhysicalPersonModel $physicalPerson)
    {
        $key = 'example_key';
        $payload = [
            'iat' => 1356999524,
            'nbf' => 1357000000,
            'id'                => $physicalPerson['id'],
            'name'              => $physicalPerson['name'],
            'cpf'              => $physicalPerson['cpf'],
            'rg'                => $physicalPerson['rg'],
            'birthDate'      =>    $physicalPerson['birthDate'],
            'cellphone'      =>    $physicalPerson['cellphone'],
            'address' => [
                'street' => $physicalPerson->address->street,
                'number' => $physicalPerson->address->number,
                'cep'  =>   $physicalPerson->address->cep,
                'city' =>   $physicalPerson->address->city,
                'uf'   =>   $physicalPerson->address->uf
            ],
            'account' => [
                'id' =>    $physicalPerson->account->id,
                'number' => $physicalPerson->account->number,
                'value' =>  $physicalPerson->account->value,
            ]
        ];

        JWT::$leeway = 10;
        $jwt = JWT::encode($payload, $key, 'HS256');
        return $jwt;
    }
}
