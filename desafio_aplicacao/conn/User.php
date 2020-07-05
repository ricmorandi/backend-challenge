<?php

class User{
    private $internalID;
    private $nome;
    private $phone;
    private $accessLevel;
    private $lastUpdate;
    private $externalID;

    public function __construct($nome,$phone,$accessLevel,$internalID,$lastUpdate,$externalID){
        $this->nome = $nome;
        $this->phone = $phone;
        $this->accessLevel = $accessLevel;
        $this->internalID = $internalID;
        $this->lastUpdate = $lastUpdate;
        $this->externalID = $externalID;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function getAccessLevel(){
        return $this->accessLevel;
    }

    public function getLastUpdate(){
        return $this->lastUpdate;
    }

    public function getExternalID(){
        return $this->externalID;
    }
    public function getInternalID(){
        return $this->internalID;
    }
}
?>