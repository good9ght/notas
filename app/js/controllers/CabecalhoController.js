angular.module("Notas").controller("CabecalhoController", function($scope, $rootScope, $location){
    $scope.usuario = $rootScope.usuario ? $rootScope.usuario : null;

    $scope.logout = function() {
        $rootScope.usuario = null;
        $location.path( "/login" );
    }

});
