<?php

  class Banco {
    // private $ultimo_cod;
    private $conexao = null;

    public function __construct() {
      // conectando com o banco
      $this->conexao = Conexao::getInstancia();
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

        // Desativa temporariamente o autocommit
        // $this->conexao->beginTransaction();

        $sql = $this->conexao->prepare(
          "INSERT INTO $tabela($colunas) values($valores);");

        $posicao = 0;

        foreach ($dados as $key => $value) {
          $posicao++;

          $sql->bindValue($posicao, $value);
        }

        $sql->execute();
        // $this->conexao->commit();

        // $this->ultimo_cod = $this->conexao->lastInsertId();

        $this->conexao = null;


      }
      catch (Exception $ex) {
        echo "Erro ao inserir!";
      }
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

        // if(!$sql) {
        //   die("Error: ". print_r($this->conexao->errorInfo(),true) );
        // }

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

    function buscarNotas($codigoUsuario) {
      $tabela = "notas";
      $colunas = "notas.codigo, notas.titulo, notas.conteudo, notas.descricao, "
        ."usuarios.nome as autor, categorias.titulo as categoria";
      $argumentos = "left join usuarios on notas.autor = usuarios.codigo "
        ."left join categorias on notas.categoria = categorias.codigo "
        ."WHERE autor = $codigoUsuario";

      return $this->buscar($tabela, $colunas, $argumentos);
    }

    function buscarNota($codigo) {
      $tabela = "notas";

      $colunas = "notas.codigo, notas.titulo, notas.conteudo, notas.descricao, "
        ."usuarios.nome as autor, categorias.titulo as categoria";

      $argumentos = "left join usuarios on notas.autor = usuarios.codigo "
        ."left join categorias on notas.categoria = categorias.codigo "
        ."where notas.codigo={$codigo}";

      return $this->buscar($tabela, $colunas, $argumentos);
    }

    function buscarNotaEditar($codigo) {
      $tabela = "notas";

      $colunas = "notas.codigo, notas.titulo, notas.conteudo, notas.descricao, "
        ."usuarios.codigo as autor, categorias.codigo as categoria ";

      $argumentos = "left join usuarios on notas.autor = usuarios.codigo "
        ."left join categorias on notas.categoria = categorias.codigo "
        ."where notas.codigo={$codigo}";

      return $this->buscar($tabela, $colunas, $argumentos);
    }

    function buscarCategorias() {
      $tabela = "categorias";
      return $this->buscar($tabela);
    }

    function buscarUsuarios(){
      $tabela = "usuarios";
      return $this->buscar($tabela);
    }
    // function buscarUsuario($colunas = "*", $id = null){
    //   $tabela = "usuarios";
    //   $argumentos = $id ? "where id = '{$id}';" : ";";
    //   $this->buscar($tabela, $colunas, $argumentos);
    // }

    function cadastrarNota($dados) {
      $this->inserir("notas", $dados);
    }

    function cadastrarUsuario($dados) {
      $this->inserir("usuarios", $dados);
    }

    function atualizarNota($dados){
      $tabela = "notas";
      $argumentos = "where codigo = $dados->codigo";
      $this->atualizar($tabela, $dados, $argumentos);
    }

    function deletarNota($codigo) {
      $tabela = "notas";
      $where = array("coluna" => "codigo", "valor" => $codigo);
      $this->deletar($tabela, $where);
    }

  }
?>
