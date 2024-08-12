<?php
 
    function inserirPessoa($conexao,$array){
       try {
            $query = $conexao->prepare("insert into pessoa (nome, email, cpf, senha) values (?, ?, ?, ?)");

            $resultado = $query->execute($array);
            
            return $resultado;
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }


    function alterarPessoa($conexao, $array){
        try {
            $query = $conexao->prepare("update pessoa set nome= ?, email = ?, cpf= ?, senha= ? where codpessoa = ? and status=true");
            $resultado = $query->execute($array);             
            return $resultado;
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function alterarPessoaPerfil($conexao, $array){
        try {
            session_start();
            $query = $conexao->prepare("update pessoa set nome= ?, email = ?, cpf= ?, senha= ? where codpessoa = ?");
            $resultado = $query->execute($array);   
            $_SESSION['nome']=$array[0];         
            return $resultado;
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    function deletarPessoa($conexao, $array){
        try {
            $query = $conexao->prepare("delete from pessoa where codpessoa = ?");
            $resultado = $query->execute($array);   
             return $resultado;
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }
 
    function listarPessoa($conexao){
      try {
        $query = $conexao->prepare("SELECT * FROM pessoa where status=true");      
        $query->execute();
        $pessoas = $query->fetchAll();
        return $pessoas;
      }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
      }  

    }

     function buscarPessoa($conexao,$array){
        try {
        $query = $conexao->prepare("select * from pessoa where codpessoa=? and status=true");
        if($query->execute($array)){
            $pessoa = $query->fetch(); //coloca os dados num array $usuario
            return $pessoa;
        }
        else{
            return false;
        }
         }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
      }  
    }

    function acessarAdmin(){

    }

    function acessarPessoa($conexao,$array,$senha_form){
        try {
        $query = $conexao->prepare("select * from pessoa where email=? and status=true");
        if($query->execute($array)){
            $pessoa = $query->fetch(); //coloca os dados num array $pessoa
        if(password_verify($senha_form, $pessoa['senha']))
            {  
                return $pessoa;
            }
        else
            {
                return false;
            }
        }
        else{
            return false;
        }
         }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
      }  
    }

 function pesquisarPessoa($conexao,$array){
        try {
        $query = $conexao->prepare("select * from pessoa where nome like ? and status=true");
        if($query->execute($array)){
            $pessoas = $query->fetchAll(); //coloca os dados num array $pessoa
          if ($pessoas)
            {  
                return $pessoas;
            }
        else
            {
                return false;
            }
        }
        else{
            return false;
        }
         }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
      }  
    }

function pesquisarPessoaEmail($conexao,$array){

    
        try {

        $query = $conexao->prepare("select * from pessoa where md5(email) = ?");
        if($query->execute($array)){
            $pessoa = $query->fetch(); //coloca os dados num array $pessoa
          if ($pessoa)
            {  
                return $pessoa;
            }
        else
            {
                return false;
            }
        }
        else{
            return false;
        }
         }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
      }  
    }

 function alterarStatustrue($conexao, $array){
        try {
            session_start();
            $query = $conexao->prepare("update pessoa set status = true where codpessoa = ?");
            $resultado = $query->execute($array);       
            return $resultado;
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

 function perdeuSenha($conexao,$array){
    try {
        $query = $conexao->prepare("select * from pessoa where email=? and status=true");
        if($query->execute($array)){
            $pessoa = $query->fetch();
            if($pessoa)
            {
                return $pessoa;
            }
            else
            {
                return false;
            }
        }
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
  function inserirRecuperacao($conexao,$array){
       try {
            $query = $conexao->prepare("insert into recuperacao (utilizador, confirmacao) values (?, ?)");

            $resultado = $query->execute($array);
            
            return $resultado;
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }
  
  
  function recuperarSenha($conexao,$array){
    try {
        $query = $conexao->prepare("select * from recuperacao where utilizador=? and confirmacao=?");
        if($query->execute($array)){
            $recuperacao = $query->fetch();
            if($recuperacao)
            {
                return $recuperacao;
            }
            else
            {
                return false;
            }
        }
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } 
    
    
    function deletarRecuperacao($conexao,$array){
    try {
        $query = $conexao->prepare("delete from recuperacao where utilizador=? and confirmacao=?");
        if($query->execute($array)){
       
                return true;
            }
            else
            {
                return false;
            }
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
      function alterarSenha($conexao, $array){
        try {
            $query = $conexao->prepare("update pessoa set senha= ? where email = ? and status=true");
            $resultado = $query->execute($array);             
            return $resultado;
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

   ?>