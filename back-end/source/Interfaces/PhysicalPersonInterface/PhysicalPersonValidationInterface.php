<?php

namespace Source\Interfaces\PhysicalPersonInterface;

interface PhysicalPersonValidationInterface 
{
    public function validateAccountHolder(array $data);
    public function mountAccountPhysic();
    public function validateFormAccountPhysic($data);
}