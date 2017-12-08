angular.module("Notas")
.controller("HomeController",
function($scope, NotasFactory, $mdToast, $mdDialog, $mdMenu, $rootScope) {
  $scope.notas = [];
  $scope.categorias = [];
  $scope.iconesClose = [];

  $scope.mudarIconeClose = function(icone) {
    let posicao = $scope.iconesClose.indexOf(icone);
    if(posicao != -1) {
      $scope.iconesClose.splice(posicao, posicao+1);
    }
    else {
      $scope.iconesClose.push(icone);
    }
    console.log($scope.iconesClose);
  }


  $scope.mostrarIconeClose = function(icone) {
    let mostrar = $scope.iconesClose.indexOf(icone) != -1;
    console.log(mostrar);
    return mostrar;
  }

  $scope.buscarNotas = function() {
    NotasFactory.buscarNotas($rootScope.usuario.codigo)
    .then(function(result) {
      // console.log(result.data);
      $scope.notas = result.data;
    });
  }

  $scope.mostrarFormularioNota = function(event, codigo) {
    $mdDialog.show({
      templateUrl: 'app/templates/dialogs/formulario-nota.html',
      controller: 'FormularioNotaController',
      parent: angular.element(document.body),
      targetEvent: event,
      clickOutsideToClose:true,
      locals : { codigo : codigo },
      fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
    })
    .then(function(resposta) {
      $scope.buscarNotas();
      $mdToast.show(
            $mdToast.simple()
              .textContent("Salva!")
              .position('top right')
              .hideDelay(1500)
          );
    }, function() {});
  };

  $scope.buscarCategorias = function() {
    NotasFactory.buscarCategorias()
    .then(function(result) {
      $scope.categorias = result.data;
      $scope.categoria = "";
    });
  }

  $scope.deletarNota = function(codigo) {
    NotasFactory.deletarNota(codigo)
    .then(function(result) {
      $scope.buscarNotas();
      $mdToast.show(
        $mdToast.simple()
          .textContent("Nota Excluída!")
          .position('top right')
          .hideDelay(1500)
        );
      })
  };

  $scope.mostrarNota = function(event, codigo) {
    $mdDialog.show({
      controller: "NotaController",
      templateUrl: 'app/templates/dialogs/nota.html',
      parent: angular.element(document.body),
      targetEvent: event,
      clickOutsideToClose:true,
      locals: { codigo: codigo },
      fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
    })
    .then(function(answer) {
      // $scope.status = 'You said the information was "' + answer + '".';
    }, function() {
      // $scope.status = 'You cancelled the dialog.';
    });
  };

  $scope.buscarNotas();
  $scope.buscarCategorias();
});
