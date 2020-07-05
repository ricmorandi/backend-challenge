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
            <table class="table" id="dinamic-list">
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tipo de Usuário</th>
                    <th>Contato</th>
                    <th>Última Atualização</th>
                    <th>ID Externo</th>
                </tr>

                <script>
                    "<?php include('conn/UserList.php'); $UserList = new UserList(); $string = $UserList->getUsersToString(); ?>"
                    var array =  "<?php echo $string; ?>";
                    var array = array.split('!!');

                    for (let i = 0; i < array.length; i ++) {
                        let tempArray = array[i].split('||');
                        var tr = document.createElement("tr");
                        let td = document.createElement("td");
                        let text = document.createTextNode(i+1);
                        tr.appendChild(td);
                        td.appendChild(text);
                        for (let j = 0; j< tempArray.length; j++) {
                            let td = document.createElement("td");
                            let text = document.createTextNode(tempArray[j]);
                            tr.appendChild(td);
                            td.appendChild(text);
                        }
                        document.getElementById("dinamic-list").appendChild(tr);
                    }
                </script>
            </table>
        </div>  
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-2">
                <button class="btn btn-primary index" type="button" onclick="location.href='./cadastro.html'">
                    Atualizar
                </button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary index" type="button" onclick="location.href='./'">
                    Gerir Usuários
                </button>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

</body>
<footer>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/verificar.js"></script>
</footer>

</html>