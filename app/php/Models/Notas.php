<?php

class Notas extends DAO {

  function buscarNotas($dados) {
    $tabela = "notas";
    $colunas = "notas.codigo, notas.titulo, notas.conteudo, notas.descricao, "
      ."usuarios.nome as autor, categorias.titulo as categoria";
    $join = "left join usuarios on notas.autor = usuarios.codigo "
      ."left join categorias on notas.categoria = categorias.codigo ";
    $argumentos = "WHERE autor=$dados->autor";

    return parent::buscar($tabela, $colunas, $argumentos, $join);
  }

  function buscarNota($codigo) {
    $tabela = "notas";
    $colunas = "notas.codigo, notas.titulo, notas.conteudo, notas.descricao, "
      ."usuarios.codigo as autor, categorias.codigo as categoria ";
    $join = "left join usuarios on notas.autor = usuarios.codigo "
      ."left join categorias on notas.categoria = categorias.codigo ";
    $argumentos = "where notas.codigo={$codigo}";

    return parent::buscar($tabela, $colunas, $argumentos, $join);
  }

  function cadastrarNota($dados) {
    parent::inserir("notas", (array) $dados);
  }

  function atualizarNota($dados) {
    $tabela = "notas";
    $argumentos = "where codigo = $dados->codigo";
    parent::atualizar($tabela, (array) $dados, $argumentos);
  }

  function deletarNota($codigo) {
    $tabela = "notas";
    $where = array("coluna" => "codigo", "valor" => $codigo);
    parent::deletar($tabela, $where);
  }
}
