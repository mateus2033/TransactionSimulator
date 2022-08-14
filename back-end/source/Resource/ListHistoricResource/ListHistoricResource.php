<?php

namespace Source\Resource\ListHistoricResource;

class ListHistoricResource
{
    /**
     * standardizes the successful return of the historic
     */
    public function toArray($request)
    {  
        foreach($request->historic as $listHistoric) {    
            $list['id']      = $listHistoric->id;
            $list['action']  = $listHistoric->action;
            $list['message'] = $listHistoric->message;
            $list['data']    = $listHistoric->data;
            $historic[] = $list; 
        }  
        return $historic;
    } 
}