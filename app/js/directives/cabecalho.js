angular.module("Notas")
.directive("cabecalho", function(){
  return {
    restrict: "E",
    templateUrl: "app/templates/directives/cabecalho.html",
    controller: "CabecalhoController"
  }
})
