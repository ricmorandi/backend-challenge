<?php

    class ComunicaAPI{
        private $cabecalho = array(
            'Authorization:Bearer aSE1gIFBKbBqlQmZOOTxrpgPKgQkgshbLnt1NS3w',
            'service-id:qualifica',
            'app-users-group-id:20',
        );

        private $url = 'https://api2.mlearn.mobi/integrator/qualifica/users';

        public function metodoPOST($nome, $accessLevel, $phone, $id, $pass){
            $ch = curl_init($this->url);
            $dados = http_build_query(array ('msisdn'=>$phone,
            'name'=>$nome,
            'access_level'=>$accessLevel,
            'password'=>$pass,
            'external_id'=>$id));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->cabecalho);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $resposta = curl_exec($ch);
            curl_close($ch);
            return $resposta;
        }
    }
?>