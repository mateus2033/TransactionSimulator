<?php

namespace Source\Resource\LegalPersonResource;

use Source\Resource\AccountResource\AccountCreateResource;
use Source\Resource\AddressResource\AddressCreateResource;

class LegalPersonResource 
{
        /**
     * standardizes the successful return of the account holder
     */
    public function toArray($request)
    {
        $array = array(
            'name'     => $request->name,
            'cnpj'     => $request->cnpj,
            'stateRegistration' => $request->stateRegistration,
            'foundationDate'    => $request->foundationDate,
            'cellphone' => $request->cellphone,
            'address'   => (new AddressCreateResource())->toArray($request->address),
            'account'   => (new AccountCreateResource())->toArray($request->account)
        );

        return $array;        
    }
}