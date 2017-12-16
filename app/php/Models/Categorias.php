<?php

class Categorias extends DAO {

  function buscarCategorias() {
    $tabela = "categorias";
    return parent::buscar($tabela);
  }
}
