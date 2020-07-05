<?php

class User{
    private $internalID;
    private $nome;
    private $phone;
    private $accessLevel;
    private $lastUpdate;
    private $externalID;
    private $password;

    public function __construct($nome,$phone,$accessLevel,$internalID,$lastUpdate,$externalID,$password){
        $this->nome = $nome;
        $this->phone = $phone;
        $this->accessLevel = $accessLevel;
        $this->internalID = $internalID;
        $this->lastUpdate = $lastUpdate;
        $this->externalID = $externalID;
        $this->password = $password;
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

    public function upgradeOrDowngrade(){
        include('comunicaAPI.php');
        include('connection.php');
        $comunicaAPI = new ComunicaAPI();
        $retorno = '';
        $backup = $this->accessLevel;
        if($this->accessLevel == 'free'){
            $this->accessLevel = 'premium';
            $retorno = $comunicaAPI->upgradeUser($this->externalID);
        }else{
            $this->accessLevel = 'free';
            $retorno = $comunicaAPI->downgradeUser($this->externalID);
        }

        if($retorno<>''){
            $update_query = "UPDATE USERS SET AccessLevel = '$this->accessLevel' WHERE PhoneNumber like '$this->phone';";
            $query_result = mysqli_query($conn,$update_query);
            if ($query_result == 1){
                return $retorno;
            }else{
                return '';
            }
        }else{
            $this->accessLevel = $backup;
            return '';
        }
    }

    public function deleteUser(){
        include('comunicaAPI.php');
        include('connection.php');
        $comunicaAPI = new ComunicaAPI();
        $retorno = '';
        $retorno_json = $comunicaAPI->deleteUser($this->externalID);
        $retorno = json_decode($retorno_json, true);
        if($retorno['data']['deleted'] == true){
            $delete_query = "DELETE FROM USERS WHERE InternalID = '$this->internalID';";
            $query_result = mysqli_query($conn,$delete_query);
            if ($query_result == 1){
                return $retorno;
            }else{
                return '';
            }
        }else{
            return '';
        }
    }

    public function updateUser($phone, $nome, $accessLevel, $password){
        include('comunicaAPI.php');
        include('connection.php');
        $comunicaAPI = new ComunicaAPI();
        $retorno = 0;
        $retorno_json = $comunicaAPI->updateUserData($this->externalID,
        $phone, $nome, $accessLevel, $password);
        $retorno = http_response_code($retorno_json);
        echo($retorno);
        if($retorno == 200){
            echo('sucesso');
            $update_query = "UPDATE USERS SET PhoneNumber = '$phone',
            Nome = '$nome', AccessLevel = '$accessLevel', Senha = '$password'
            where InternalID = '$this->internalID';";
            $query_result = mysqli_query($conn, $update_query);
            if($query_result==1){
                return 'updated';
            }else{
                return '';
            }
        }else{
            return '';
        }

    }

    public function verifyUser(){
        include('comunicaAPI.php');
        include('connection.php');
        $comunicaAPI = new ComunicaAPI();
        $retorno = '';
        $retorno = $comunicaAPI->getUser($this->externalID);
        if($retorno == ''){
            return '';
        }else{
            $decoded = json_decode($retorno,true);
            if($decoded['data']["msisdn"] <> $this->phone || $decoded['data']["name"] <> $this->nome
            || $decoded['data']["access_level"] <> $this->accessLevel){
                return $this->updateUser($decoded['data']["msisdn"], 
                $decoded['data']["name"], 
                $decoded['data']["access_level"], 
                $this->password);
            }else{
                return 'ok';
            }
        }
  
    }



}
?>