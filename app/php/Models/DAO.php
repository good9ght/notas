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
        $valores .= ":$key, ";
      }

      $colunas = substr($colunas, 0, strlen($colunas)-2);
      $valores = substr($valores, 0, strlen($valores)-2);

      // Desativando temporariamente o autocommit
      $this->conexao->beginTransaction();

      $sql = $this->conexao->prepare(
        "INSERT INTO $tabela($colunas) values($valores);");

      $sql->execute($dados);

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
        $colunas .= "$key=:$key, ";
      }
      $colunas = substr($colunas, 0, strlen($colunas)-2);

      $sql = $this->conexao->prepare(
        "UPDATE  $tabela SET $colunas $argumentos");

      $sql->execute($dados);
    }
    catch (Exception $ex) {
      echo "Erro ao inserir!";
    }
    $this->conexao = null;
  }


  function buscar($tabela, $colunas = "*", $argumentos = "", $join = "") {
    $resultado = array();

    try{
      $sql = $this->conexao->query("SELECT $colunas from $tabela $join $argumentos;");

      if(!$sql) {
        die("Error: ". print_r($this->conexao->errorInfo(),true) );
      }
      $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $erroSql) {
      echo "Erro ao Buscar! ".$erroSql;
    }
    // // Encerrando conexão
    $this->conexao = null;

    return $resultado;
  }

  function deletar($tabela, $where) {
    try {
      $coluna = $where["coluna"];
      $valor = $where["valor"];

      $sql = $this->conexao->prepare("DELETE FROM $tabela WHERE $coluna=:$coluna;");
      $sql->bindValue($coluna, $valor);

      $sql->execute($where);
      $this->conexao = null;
    }
    catch (Exception $ex) {
      echo "Erro ao deletar!";
    }
  }
}
