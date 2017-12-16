<?php

class Notas extends DAO {

  function buscarNotas($notas) {
    $tabela = "notas";
    $colunas = "notas.codigo, notas.titulo, notas.conteudo, notas.descricao, "
      ."usuarios.nome as autor, categorias.titulo as categoria";
    $argumentos = "left join usuarios on notas.autor = usuarios.codigo "
      ."left join categorias on notas.categoria = categorias.codigo "
      ."WHERE autor = $notas->autor";

    return parent::buscar($tabela, $colunas, $argumentos);
  }

  function cadastrarNota($dados) {
    parent::inserir("notas", $dados);
  }

  function atualizarNota($dados) {
    $tabela = "notas";
    $argumentos = "where codigo = $dados->codigo";
    parent::atualizar($tabela, $dados, $argumentos);
  }

  function deletarNota($codigo) {
    $tabela = "notas";
    $where = array("coluna" => "codigo", "valor" => $codigo);
    parent::deletar($tabela, $where);
  }

  function buscarNota($codigo) {
    $tabela = "notas";

    $colunas = "notas.codigo, notas.titulo, notas.conteudo, notas.descricao, "
      ."usuarios.codigo as autor, categorias.codigo as categoria ";

    $argumentos = "left join usuarios on notas.autor = usuarios.codigo "
      ."left join categorias on notas.categoria = categorias.codigo "
      ."where notas.codigo={$codigo}";

    return parent::buscar($tabela, $colunas, $argumentos);
  }
}
