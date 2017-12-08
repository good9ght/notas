<?php

include '../Model/Conexao.php';
include '../Model/Banco.php';
include '../Model/Validar.php';

$op = $_GET["op"];

switch ($op) {
	case 'validarLogin':
		$validar = new Validar();
		$dados = json_decode(file_get_contents('php://input'));

		echo json_encode($validar->validarLogin($dados));
		break;

	case 'enviarNota':
		$banco = new Banco();
		$dados = json_decode(file_get_contents('php://input'));

		echo $banco->cadastrarNota($dados);
		break;

	case 'buscarNotas':
		$banco = new Banco();
		$dados = json_decode(file_get_contents('php://input'));

		echo json_encode($banco->buscarNotas($dados->codigoUsuario));

		break;

	case 'buscarNota':
		$banco = new Banco();
		$dados = json_decode(file_get_contents('php://input'));
		echo json_encode($banco->buscarNota($dados->codigo));
		break;

	case 'buscarCategorias':
		$banco = new Banco();
		echo json_encode($banco->buscarCategorias());
		break;

	case 'buscarUsuarios':
		$banco = new Banco();
		echo json_encode($banco->buscarUsuarios());
		break;

	case 'buscarNotaEditar':
		$banco = new Banco();
		$dados = json_decode(file_get_contents('php://input'));
		echo json_encode($banco->buscarNotaEditar($dados->codigo));
		break;

	case 'atualizarNota':
		$banco = new Banco();
		$dados = json_decode(file_get_contents('php://input'));

		echo $banco->atualizarNota($dados);
		break;

	case 'deletarNota':
		$banco = new Banco();
		$dados = json_decode(file_get_contents('php://input'));

		echo $banco->deletarNota($dados);
		break;

	case 'cadastrarUsuario':
		$banco = new Banco();
		$dados = json_decode(file_get_contents('php://input'));

		echo $banco->cadastrarUsuario($dados);
		break;

	default:
		# code...
		break;
}
