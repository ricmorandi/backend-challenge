<?php

class UserList{
    

    private $users;

    public function __construct(){
        include 'connection.php';
        $query = "SELECT U.InternalID,
                        U.Nome,
                        U.AccessLevel,
                        U.PhoneNumber,
                        U.LastUpdate,
                        U.ExternalID,
                        U.Senha 
        FROM USERS U";
        $query_array = mysqli_fetch_all(mysqli_query($conn,$query));
        for($i=0; $i < count($query_array); $i++){
            $this->users[] = $query_array[$i];
        }
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function getUsersToString(){
        $string = array();
        for($i=0; $i < count($this->users); $i++){
            $string[] = implode('||',$this->users[$i]);
        }
        return implode('!!',$string);
    }
}

?>