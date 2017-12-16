angular.module("Notas")
.controller("FormularioNotaController",
function($scope, NotasFactory, $rootScope, $mdDialog, codigo) {
  $scope.nota = {};
  $scope.nota.codigo = codigo;
  $scope.nota.titulo = null;
  $scope.nota.descricao = null;
  $scope.nota.conteudo = null;
  $scope.nota.autor = $rootScope.usuario.codigo;
  $scope.nota.categoria = null;

  $scope.categorias = [];
  $scope.usuarios = [];

  $scope.buscarNota = function() {
    if($scope.nota.codigo) {
      NotasFactory.buscarNota($scope.nota.codigo)
      .then(function(result) {
        $scope.nota = result.data[0];
      });
    }
  }

  $scope.buscarCategorias = function() {
    NotasFactory.buscarCategorias()
    .then(function(result) {
      $scope.categorias = result.data;
    });
  }

  $scope.enviarNota = function() {
    if($scope.nota.codigo){
      console.log($scope.nota);
      NotasFactory.atualizarNota($scope.nota)
      .then(function(result) {
        $mdDialog.hide();
      });
    }
    else{
      NotasFactory.enviarNota($scope.nota)
      .then(function(result) {
        $mdDialog.hide();
      });
    }
  }

  $scope.cancelar = function() {
    $mdDialog.cancel();
  }

  $scope.buscarCategorias();
  $scope.buscarNota();
});
