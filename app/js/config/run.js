angular.module("Notas")
.run(function($rootScope, $location) {
  $rootScope.$on('$routeChangeStart', function (event) {
    if ($rootScope.usuario == null) {
        console.log("Negar");
        $location.path("/login");
    }
    else {
        console.log("Permitir");
        $location.path("/home");
    }
  });
});
