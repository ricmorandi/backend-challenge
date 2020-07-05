<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Desafio de aplicação</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/default.css" type="text/css">
</head>

<body>
    <div class="container">
        <header>
            <h2>Gestão de Usuários</h2>
        </header>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <form action="conn/editUser.php" method="POST">
                    <table class="table" id="dinamic-list">
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Tipo de Usuário</th>
                            <th>Contato</th>
                            <th>Última Atualização</th>
                            <th>ID Externo</th>
                            <th></th>
                        </tr>
                        <div id="users">
                        <script>
                            "<?php include('conn/UserList.php'); $UserList = new UserList(); $string = $UserList->getUsersToString(); ?>"
                            var array = "<?php echo $string; ?>";
                            var array = array.split('!!');
                            "<?php $enable = false ?>";
                            for (let i = 0; i < array.length; i++) {
                                let tempArray = array[i].split('||');
                                var tr = document.createElement("tr");
                                let td = document.createElement("td");
                                let text = document.createTextNode(" ");
                                tr.appendChild(td);
                                td.appendChild(text);
                                for (let j = 0; j < tempArray.length-1; j++) {
                                    td = document.createElement("td");
                                    text = document.createTextNode(tempArray[j]);
                                    tr.appendChild(td);
                                    td.appendChild(text);
                                }
                                td = document.createElement("td");
                                let input = document.createElement("input")
                                input.type = "radio";
                                input.value = tempArray[0];
                                input.id = "user";
                                input.name = "user";
                                
                                tr.appendChild(td);
                                td.appendChild(input);
                                document.getElementById("dinamic-list").appendChild(tr);
                            }
                        </script>
                        </div>
                    </table>
                    <button class="btn btn-primary index" type="button"  onclick="location.href='./';">
                        Voltar
                    </button>
                    <button class="btn btn-primary index" type="submit" id="button" value="deleteUser" name="type" >
                        Deletar </button>
                    <button class="btn btn-primary index" type="submit" id="button" value="upDownUser" name="type" >
                        Up/Downgrade
                    </button>
                    <button class="btn btn-primary index" type="submit" id="button" value="verifyUser" name="type" >
                        Verifica usuário
                    </button>
                </form>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</body>
<footer>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/verificar.js"></script>
</footer>

</html>