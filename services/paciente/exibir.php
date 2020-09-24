<?php

header("Access-Control-Allow-Origin:*");

header("Content-Type:application/json;charset=utf-8"); 

include_once "../../config/database.php";
include_once "../../domain/paciente.php";

$database = new Database();

$db=$database->getConnection();

$paciente = new Paciente($db);

$resultado = $paciente->listar();

if($resultado->rowCount()>0){
    $paciente_arr["saida"] = array();

    while($linha = $resultado->fetch(PDO::FETCH_ASSOC)){

        extract($linha);

        $array_item=array(
            "idpaciente"=>$idpaciente,
            "nome"=>$nome,
            "cpf"=>$cpf,
            "datanasc"=>$datanasc,
            "email"=>$email,
            "sexo"=>$sexo,
            "celular"=>$celular,
            "nomemae"=>$nomemae,

            "tipo"=>$tipo,
            "logradouro"=>$logradouro,
            "numero"=>$numero,
            "complemento"=>$complemento,
            "bairro"=>$bairro,
            "cep"=>$cep

        );
        array_push($paciente_arr["saida"],$array_item);
    }
    header("HTTP/1.0 200");
    echo json_encode($paciente_arr);
}else{
header("HTTP/1.0 400");
echo json_encode(array("mansagem"=>"Não Foi possivel lista os pacientes"));
}

?>