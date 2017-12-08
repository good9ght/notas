angular.module("Notas").controller("LoginController",
function($scope, $location, $rootScope, NotasFactory, $mdDialog, $mdToast) {
  $scope.dados = {};
  $scope.dados.email = null;
  $scope.dados.senha = null;

  $scope.logar = function() {
    NotasFactory.validarLogin($scope.dados)
    .then(function(result){
    	// console.log(result);
      if(result.data[0].codigo) {
        $rootScope.usuario = result.data[0];
        $location.path( "/home" );
      }
    });
  }


  $scope.abrirCadastro = function(event) {
    $mdDialog.show({
        controller: "CadastroUsuarioController",
        templateUrl: 'app/templates/dialogs/formulario-cadastro.html',
        parent: angular.element(document.body),
        targetEvent: event,
        // clickOutsideToClose:true,
        fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
    })
    .then(function(answer) {
      $mdToast.show(
        $mdToast.simple()
          .textContent("Cadastrado!")
          .position('top right')
          .hideDelay(1500)
        );

    }, function() {

    });
  };
});
