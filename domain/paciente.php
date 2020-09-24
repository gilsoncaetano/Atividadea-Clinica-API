<?php

class Paciente{

    public $idpaciente;
    public $nome;
    public $cpf;
    public $datanasc;
    public $email;
    public $sexo;
    public $celular;
    public $nomemae;
    public $senha;
    public $tipo;
    public $logradouro;
    public $numero;
    public $complemento;
    public $bairro;
    public $cep;

    public function __construct($db){
        $this->conexao = $db;
    }

    public function listar(){
        $consulta = "select 
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
        ";

        $stmt=$this->conexao->prepare($consulta);

        $stmt->execute();

        return $stmt;
    }

    public function listaTelaInicial(){
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

        $stmt ->execute();

        return $stmt;
    }

    public function cadastro(){
        $consulta = "insert into paciente set nome=:n, cpf=:c, datanasc=:d, email=:e, sexo=:s, celular=:cl, nomemae=:m, senha=:sh";
       
        $stmt=$this->conexao->prepare($consulta); 

        //Criptografia de senha
        $this->senha = md5($this->senha);
        
        $stmt->bindParam(":n",$this->nome);
        $stmt->bindParam(":c",$this->cpf);
        $stmt->bindParam(":d",$this->datanasc);
        $stmt->bindParam(":e",$this->email);
        $stmt->bindParam(":s",$this->sexo);
        $stmt->bindParam(":cl",$this->celular);
        $stmt->bindParam(":m",$this->nomemae);
        $stmt->bindParam(":sh",$this->senha);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function atualizar(){
        $consulta = "insert into paciente set nome=:n, cpf=:c, datanasc=:d, email=:e, sexo=:s, celular=:cl, nomemae=:m, senha=:sh";
       
        $stmt=$this->conexao->prepare($consulta);   
        
        $stmt->bindParam(":n",$this->nome);
        $stmt->bindParam(":c",$this->cpf);
        $stmt->bindParam(":d",$this->datanasc);
        $stmt->bindParam(":e",$this->email);
        $stmt->bindParam(":s",$this->sexo);
        $stmt->bindParam(":cl",$this->celular);
        $stmt->bindParam(":m",$this->nomemae);
        $stmt->bindParam(":sh",$this->senha);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    
    }

    public function delete(){
        $consulta = "delete from paciente where idpaciente=:id";
       
        $stmt=$this->conexao->prepare($consulta);   
        
        $stmt->bindParam(":id",$this->idpaciente);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    
    }

}  
 




?>