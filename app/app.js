angular.module("Notas", [ "ngRoute", "ngMaterial", "ngAnimate", "ngAria"]).run(function($rootScope, $location) {
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

    // $mdIconProvider
    // .iconSet("call", 'img/icons/sets/communication-icons.svg', 24)
    // .iconSet("social", 'img/icons/sets/social-icons.svg', 24);

})
