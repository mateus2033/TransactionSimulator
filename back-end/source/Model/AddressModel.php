<?php

namespace Source\Model;

use Illuminate\Database\Eloquent\Model;

class AddressModel extends Model
{

    protected $table = 'address';
    protected $fillable = ['id','street', 'number', 'cep', 'city', 'uf'];

    private string $street; 
    private string $number; 
    private string $cep;
    private string $city; 
    private string $uf;

    public function getStreet()
    {
        return $this->street;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getUf()
    {
        return $this->uf;
    }

    public function setStreet($street)
    {
        $this->street = $street;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function setUf($uf)
    {
        $this->uf = $uf;
    }

    public function legalPerson()
    {
        return $this->hasOne(LegalPersonModel::class, 'account_id');
    }

    public function physicalPerson()
    {
        return $this->hasOne(PhysicalPersonModel::class, 'account_id');
    }
}
