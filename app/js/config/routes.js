angular.module("Notas").config(function($routeProvider) {
   $routeProvider
   .when("/login", {
       templateUrl : "app/templates/login.html",
       controller: "LoginController"
   })
   .when("/home", {
       templateUrl : "app/templates/home.html",
       controller: "HomeController"
   })
   .otherwise({"redirectTo":"/home"})
});
