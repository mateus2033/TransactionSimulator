<?php

namespace Source\Model;

use Illuminate\Database\Eloquent\Model;

class HistoricModel extends Model
{

    protected $table = 'historics';
    protected $fillable = ['action', 'message', 'data', 'physical_people_id', 'legal_people_id'];


}