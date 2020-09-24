<?php

class Login{

public $idpaciente;
public $nome;
public $cpf;
public $datanasc;
public $email;
public $sexo;
public $celular;
public $nomemae;
public $tipo;
public $logradouro;
public $numero;
public $complemento;
public $bairro;
public $cep;

public function __construct($db){
    $this->conexao = $db;
}

public function login(){
    $query = "select 
    cli.idpaciente,
    cli.nome,
    cli.cpf,
    cli.datanasc,
    cli.email,
    cli.sexo,
    cli.celular,
    cli.nomemae,
    en.tipo,
    en.logradouro,
    en.numero,
    en.complemento,
    en.bairro,
    en.cep 
    from endereco en inner join paciente cli on en.idpaciente=cli.idpaciente 
    where email=:e and senha=:s";

    $stmt = $this->conexao->prepare($query);

    $this->senha = md5($this->senha);

    $stmt->bindParam(":e",$this->email);
    $stmt->bindParam(":s",$this->senha);
    $stmt->execute();

    return $stmt;

    }
}

?>

