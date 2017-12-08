<?php
	class Validar{

		function validarLogin($dados){
			
			$banco = new Banco();
			$email = $dados->email;
			$senha = $dados->senha;
			$tabela = "usuarios";
			$argumentos = "WHERE email='{$email}' AND senha='{$senha}'";
			return $banco->buscar($tabela, "*", $argumentos);
		}
	}
