<?php

    class ComunicaAPI{
        private $cabecalho = array(
            'Authorization:Bearer aSE1gIFBKbBqlQmZOOTxrpgPKgQkgshbLnt1NS3w',
            'service-id:qualifica',
            'app-users-group-id:20'
        );

        private $url = 'https://api2.mlearn.mobi/integrator/qualifica/users';

        public function metodoPOST($nome, $accessLevel, $phone, $internalID, $pass){
            $url = curl_init($this->url);
            $dados = http_build_query(array ('msisdn'=>$phone,
            'name'=>$nome,
            'access_level'=>$accessLevel,
            'password'=>$pass,
            'external_id'=>$internalID));
            curl_setopt($url, CURLOPT_POST, 1);
            curl_setopt($url, CURLOPT_HTTPHEADER, $this->cabecalho);
            curl_setopt($url, CURLOPT_POSTFIELDS, $dados);
            curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
            $resposta = curl_exec($url);
            curl_close($url);
            return $resposta;
        }

        public function downgradeUser($externalID){
            $urlPUT = $this->url . "/" . $externalID . "/downgrade";

            $url = curl_init();
      
            curl_setopt($url, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($url, CURLOPT_URL, $urlPUT);
            curl_setopt($url, CURLOPT_HTTPHEADER, $this->cabecalho);
            curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
            $resposta = curl_exec($url);
            curl_close($url);
            return $resposta;
        }

        public function upgradeUser($externalID){
            $urlPUT = $this->url . "/" . $externalID . "/upgrade";
            $url = curl_init();
      
            curl_setopt($url, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($url, CURLOPT_URL, $urlPUT);
            curl_setopt($url, CURLOPT_HTTPHEADER, $this->cabecalho);
            curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
            $resposta = curl_exec($url);
            curl_close($url);
            return $resposta;
        }

        public function deleteUser($externalID){
            $urlDELETE = $this->url . "/" . $externalID;
            $url = curl_init();
      
            curl_setopt($url, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($url, CURLOPT_URL, $urlDELETE);
            curl_setopt($url, CURLOPT_HTTPHEADER, $this->cabecalho);
            curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
            $resposta = curl_exec($url);
            curl_close($url);
            return $resposta;
        }

        public function buscaUser($phone,$internalID){
            $urlBUSCA = $this->url.'?external_id='.$internalID;
            $url = curl_init();
            $dados = http_build_query(array ('msisdn'=>$phone,
            'external_id'=>$internalID));

            curl_setopt($url, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($url, CURLOPT_URL, $urlBUSCA);
            curl_setopt($url, CURLOPT_HTTPHEADER, $this->cabecalho);
            curl_setopt($url, CURLOPT_POSTFIELDS, $dados);
            curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
            $resposta = curl_exec($url);
            curl_close($url);
            return $resposta;
        }

        public function getUser($externalID){
            $urlBUSCA = $this->url.'/'.$externalID;
            $url = curl_init();

            curl_setopt($url, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($url, CURLOPT_URL, $urlBUSCA);
            curl_setopt($url, CURLOPT_HTTPHEADER, $this->cabecalho);
            curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
            $resposta = curl_exec($url);
            curl_close($url);
            $decoded = json_decode($resposta,true);
            if(key_exists('status_code',$decoded)){
                return '';
            }else{
                return $resposta;
            }
        }

        public function updateUserData($externalID,$phone,$nome,$accessLevel,$senha){
            $urlBUSCA = $this->url.'/'.$externalID;
            $url = curl_init();
            $dados = http_build_query(array ('msisdn'=>$phone,
            'name'=>$nome,
            'access_level'=>$accessLevel,
            'password'=>$senha));
            curl_setopt($url, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($url, CURLOPT_URL, $urlBUSCA);
            curl_setopt($url, CURLOPT_HTTPHEADER, $this->cabecalho);
            curl_setopt($url, CURLOPT_POSTFIELDS, $dados);
            curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
            $resposta = curl_exec($url);
            curl_close($url);
            return $resposta;
        }
    }
?>