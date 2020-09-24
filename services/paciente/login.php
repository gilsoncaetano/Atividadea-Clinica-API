<?php


header("Access-Control-Allow-Origin:*");

header("Content-Type: application/json;charset=utf-8");

header("Access-Controll-Allow-Methods:POST");

include_once "../../config/database.php";

include_once "../../domain/login.php";

$database = new Database();


$db = $database->getConnection();

$login = new Login($db);

$data = json_decode(file_get_contents("php://input"));

$login->email = $data->email;
$login->senha = $data->senha;

$rs = $login->login();


if($rs->rowCount()>0){
    $login_arr["saida"] = array();

    while($linha = $rs->fetch(PDO::FETCH_ASSOC)){

       
        extract($linha);
        $array_item = array(
            "idpaciente"=>$idpaciente,
            "nome"=>$nome,
             "cpf"=> $cpf,
             "datanasc"=> $datanasc,
             "email"=>$email,
             "sexo"=> $sexo,
             "celular"=>$celular,
             "tipo"=> $tipo,
             "logradouro"=>$logradouro,
             "numero"=> $numero,
             "complemento"=>$complemento,
             "bairro"=>$bairro,
             "cep"=>$cep
        );

        array_push($login_arr["saida"],$array_item);

    }

    header("HTTP/1.0 200");
    echo json_encode($login_arr);
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"E-mail ou senha incorreto"));
}
?>