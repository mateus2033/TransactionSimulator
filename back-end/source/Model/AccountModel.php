<?php

namespace Source\Model;

use Illuminate\Database\Eloquent\Model;

class AccountModel extends Model { 

    protected $table = 'accounts';
    protected $fillable = ['id','value','number'];

    private float $value;
    private int $number;

    public function getValue()
    {
        return $this->value;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function setNumber($number)
    {
        $this->number = $number;
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
