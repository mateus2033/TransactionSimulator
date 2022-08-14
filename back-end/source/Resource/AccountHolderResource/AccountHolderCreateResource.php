<?php

namespace Source\Resource\AccountHolderResource;

use Source\Resource\AccountResource\AccountCreateResource;
use Source\Resource\AddressResource\AddressCreateResource;

class AccountHolderCreateResource 
{
    /**
     * standardizes the successful return of the account holder
     */
    public function toArray($request)
    {

        $array = array(
            'name' => $request->name,
            'cpf'  => $request->cpf,
            'rg'   => $request->rg,
            'birthDate' => $request->birthDate,
            'cellphone' => $request->cellphone,
            'address'   => (new AddressCreateResource())->toArray($request->address),
            'account'   => (new AccountCreateResource())->toArray($request->account)
        );

        return $array;        
    }
}