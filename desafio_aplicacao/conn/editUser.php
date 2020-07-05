<?php
    $typeTrans = $_POST['type'];
 
    if(empty($_POST['user'])){
        echo("<script type='text/javascript'>
            
        alert('Usuário não selecionado!');
        
        window.location='../gerirUsuarios.php';

        </script>");
        exit();
    }
    
    $userInternalID = $_POST['user'];


    include('connection.php');

    $query = "SELECT
                U.NOME,
                U.PHONENUMBER,
                U.ACCESSLEVEL,
                U.INTERNALID,
                U.LASTUPDATE,
                U.EXTERNALID,
                U.SENHA
            FROM USERS U
            WHERE U.InternalID = '$userInternalID';
    ";

    $query_array = mysqli_fetch_all(mysqli_query($conn,$query));


    include('User.php');
    $User = new User($query_array[0][0],$query_array[0][1],$query_array[0][2],$query_array[0][3],$query_array[0][4],$query_array[0][5],$query_array[0][6]);
    $retorno = '';

    if($typeTrans == "deleteUser"){
        $retorno = $User->deleteUser();
    }else  if($typeTrans == "upDownUser"){
        $retorno = $User->upgradeOrDowngrade();
    }else if($typeTrans == "verifyUser"){
        $retorno = $User->verifyUser();
    }

    if($retorno <> '' && $typeTrans == "upDownUser"){
        echo("<script type='text/javascript'>
            
        alert('Alteração realizada com sucesso!');
        
        window.location='../gerirUsuarios.php';

        </script>");
    } else if($retorno <> '' && $typeTrans == "deleteUser" && $retorno['data']['deleted']){
        echo("<script type='text/javascript'>
            
        alert('Usuário removido com sucesso!');
        
        window.location='../gerirUsuarios.php';

        </script>");
    } else if($retorno <> '' && $typeTrans == "verifyUser"){

        if($retorno == 'ok'){
            echo("<script type='text/javascript'>
            alert('Dados conferem com a API.');
            window.location='../gerirUsuarios.php';
            </script>");
        }else if($retorno == 'updated'){
            echo("<script type='text/javascript'>
            alert('Dados atualizados.');
            window.location='../gerirUsuarios.php';
            </script>");
        }
    } else{
        echo("<script type='text/javascript'>
        alert('Ocorreu algum erro de comunicação ou o usuário não está na base de dados da API.');
        window.location='../gerirUsuarios.php';
        </script>");
    }



?>