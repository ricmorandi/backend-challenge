<?php
    
    include('connection.php');

    $nome = mysqli_real_escape_string($conn,$_POST['nome']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $password = mysqli_real_escape_string($conn,$_POST['pass']);
    $accessLevel = mysqli_real_escape_string($conn,$_POST['accessLevel']);

    $verificar_phone ="SELECT * FROM USERS WHERE PhoneNumber like '$phone';";

    if ( mysqli_num_rows(mysqli_query($conn,$verificar_phone)) > 0 || strlen($phone) <> 14 ) {

        echo "<script type='text/javascript'>
        
        alert('Dados inseridos incorretamente ou já presentes no banco');
        
        window.location='../cadastro.html';

        </script>";

        exit();
    }

    $insert_user_query = "INSERT INTO USERS(Nome,Senha,PhoneNumber,AccessLevel) VALUES ('$nome','$password','$phone','$accessLevel');";

    $query_result = mysqli_query($conn, $insert_user_query);

    if($query_result==1){

        include('comunicaAPI.php');
        $ComunicaAPI = new ComunicaAPI;

        $query = "SELECT InternalID FROM USERS WHERE PhoneNumber like '$phone';";
        $id = mysqli_fetch_all(mysqli_query($conn,$query))[0][0];

        $retorno_json = $ComunicaAPI->metodoPOST($nome,$accessLevel,$phone,$pass,$id);
        $json_array = json_decode($retorno_json, true);
        $externalID = $json_array['data']['id'];

        $insert_extID = "UPDATE USERS SET ExternalID = '$externalID' WHERE PhoneNumber like '$phone';";
        $query_result = mysqli_query($conn,$insert_extID);

        if($query_result==1){
            echo("<script type='text/javascript'>
            
            alert('Registro realizado com sucesso!');
            
            window.location='../';

            </script>");
        }else{
            echo "<script type='text/javascript'>
        
            alert('Erro ao atribuir ExternalID');
        
            window.location='../';

        </script>";
        }
    }else{
        echo "<script type='text/javascript'>
        
            alert('Erro ao realizar cadastro');
        
            window.location='../';

        </script>";
    }

?>