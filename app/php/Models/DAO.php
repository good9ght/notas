<?php

// Data Access Object
class DAO {
  private $lastInsertId;
  private $conexao = null;

  public function __construct() {
    // conectando com o banco
    $this->conexao = Conexao::getInstancia();
  }

  function __get($name) {
    return $this->$name;
  }

  function inserir($tabela, $dados) {
    try {
      $colunas = "";
      $valores = "";

      foreach ($dados as $key => $value) {
        $colunas .= "$key, ";
        $valores .= "?, ";
      }

      $colunas = substr($colunas, 0, strlen($colunas)-2);
      $valores = substr($valores, 0, strlen($valores)-2);

      // Desativando temporariamente o autocommit
      $this->conexao->beginTransaction();

      $sql = $this->conexao->prepare(
        "INSERT INTO $tabela($colunas) values($valores);");

      $posicao = 0;

      foreach ($dados as $key => $value) {
        $posicao++;

        $sql->bindValue($posicao, $value);
      }

      $sql->execute();
      $this->conexao->commit();

      $this->lastInsertId = $this->conexao->lastInsertId();

    }
    catch (PDOException $e) {
      echo "Erro ao inserir! ".$e->getMessage();
    }
    $this->conexao = null;
  }


  function atualizar($tabela, $dados, $argumentos = "") {
    try {
      $colunas = "";

      foreach ($dados as $key => $value) {
        $colunas .= "$key=?, ";
      }

      $colunas = substr($colunas, 0, strlen($colunas)-2);


      $sql = $this->conexao->prepare(
        "UPDATE  $tabela SET $colunas $argumentos");

      $posicao = 0;
      foreach ($dados as $key => $value) {
        $posicao++;
        $sql->bindValue($posicao, $value);
      }

      $sql->execute();

      $this->conexao = null;


    }
    catch (Exception $ex) {
      echo "Erro ao inserir!";
    }
  }


  function buscar($tabela, $colunas = "*", $argumentos = "") {
    $array = array();

    try{
      $sql = $this->conexao->query("SELECT $colunas from $tabela $argumentos;");

      if(!$sql) {
        die("Error: ". print_r($this->conexao->errorInfo(),true) );
      }

      $array = $sql->fetchAll(PDO::FETCH_ASSOC);
      // Encerrando conexão
      $this->conexao = null;
    }
    catch(Exception $erroSql) {
      echo "Erro ao Buscar! ".$erroSql;
    }
    return $array;
  }

  function deletar($tabela, $where) {
    try {
      $coluna = $where["coluna"];
      $valor = $where["valor"];

      $sql = $this->conexao->prepare("DELETE FROM $tabela WHERE $coluna=$valor;");

      $sql->execute();
      $this->conexao = null;
    }
    catch (Exception $ex) {
      echo "Erro ao deletar!";
    }
  }
}
