angular.module("Notas")
.controller("CadastroUsuarioController", function($scope, NotasFactory, $mdDialog) {

  $scope.cancelar = function() {
    $mdDialog.cancel();
  }

  $scope.enviardados = function() {
    NotasFactory.cadastrarUsuario($scope.dados)
    .then(function(result){
        $mdDialog.hide();
    });
  }


});
