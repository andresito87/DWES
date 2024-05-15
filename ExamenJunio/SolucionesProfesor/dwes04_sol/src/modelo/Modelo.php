<?php

namespace DWES04SOL\modelo;

abstract class Modelo implements IGuardable
{
    private ?int $id=null;
    
    public function getId():?int
    {
        return $this->id;
    }
    
    protected function setId($id):bool
    {
        $this->id=$id;
        return true;
    }
}

