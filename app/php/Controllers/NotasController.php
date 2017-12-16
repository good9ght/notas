<?php

include '../Conexao.php';
include '../Models/DAO.php';
include '../Models/Notas.php';
include '../Models/Categorias.php';

$op = $_GET["op"];
$dados = json_decode(file_get_contents('php://input'));
$notas = new Notas();
$categorias = new Categorias();

switch ($op) {
	case 'buscarNotas':
		echo json_encode($notas->buscarNotas($dados));
	break;

	case 'enviarNota':
		echo $notas->cadastrarNota($dados);
		break;

	case 'buscarNota':
		echo json_encode($notas->buscarNota($dados->codigo));
		break;

	case 'atualizarNota':
		echo $notas->atualizarNota($dados);
		break;

	case 'deletarNota':
		echo $notas->deletarNota($dados);
		break;

	case 'buscarCategorias':
		echo json_encode($categorias->buscarCategorias());
		break;

	default:
	 	return false;
		break;
}
