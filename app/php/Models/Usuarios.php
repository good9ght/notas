<?php

class Usuarios extends DAO{

	function validarLogin($dados) {
		$email = $dados->email;
		$senha = $dados->senha;
		$tabela = "usuarios";
		$argumentos = "WHERE email='{$email}' AND senha='{$senha}'";
		return parent::buscar($tabela, "*", $argumentos);
	}

	function cadastrarUsuario($dados) {
    parent::inserir("usuarios", $dados);
  }

	function buscarUsuarios() {
    $tabela = "usuarios";
    return parent::buscar($tabela);
  }
}
