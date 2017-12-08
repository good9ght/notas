angular.module("Notas").controller('MainController',  [ "$scope", "$rootScope",function($scope, $rootScope, $location){

    $scope.usuario = angular.copy($rootScope.usuario);

    $scope.logout = function(){
        $rootScope.usuario = null;
        $location.path( "/login" );
    }
}]);
