<?php

class Paciente{

    public $idpaciente;
    public $nome;
    public $email;
    public $sexo;
    public $telefone;
    public $datanascimento;
    public $usuario;
    public $senha;

    public function __construct($db){
        $this->conexao = $db;
    }

    public function listar(){
        $consulta = "select * from paciente";

        $stmt=$this->conexao->prepare($consulta);

        $stmt->execute();

        return $stmt;
    }
    public function cadastro(){
        $consulta = "insert into paciente set nome=:n, email=:e, sexo=:s, telefone=:t, datanascimento=:d, usuario=:u, senha=:sh";
       
        $stmt=$this->conexao->prepare($consulta); 

        //Criptografia de senha
        $this->senha = md5($this->senha);
        
        $stmt->bindParam(":n",$this->nome);
        $stmt->bindParam(":e",$this->email);
        $stmt->bindParam(":s",$this->sexo);
        $stmt->bindParam(":t",$this->telefone);
        $stmt->bindParam(":d",$this->datanascimento);
        $stmt->bindParam(":u",$this->usuario);
        $stmt->bindParam(":sh",$this->senha);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function atualizar(){
        $consulta = "update paciente set nome=:n, email=:e, sexo=:s, telefone=:t, datanascimento=:d, usuario=:u, senha=:sh where idpaciente=:id";
       
        $stmt=$this->conexao->prepare($consulta);   
        
        $stmt->bindParam(":n",$this->nome);
        $stmt->bindParam(":e",$this->email);
        $stmt->bindParam(":s",$this->sexo);
        $stmt->bindParam(":t",$this->telefone);
        $stmt->bindParam(":d",$this->datanascimento);
        $stmt->bindParam(":u",$this->usuario);
        $stmt->bindParam(":sh",$this->senha);
        $stmt->bindParam(":id",$this->idpaciente);

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