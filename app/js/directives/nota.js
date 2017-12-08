angular.module("Notas")
.directive("nota", function() {
  return {
    restrict: "E",
    templateUrl: "app/templates/directives/nota.html",
    // scope: {},
    link: function(scope, element) {
      let botaoNota = element[0].querySelector(".ver-conteudo");

      angular.element(botaoNota).on("click", function() {

        var nota = element[0].querySelector('.conteudo-nota');
        var notaTitulo = element[0].querySelector('.titulo-conteudo');
        var notaTexto = element[0].querySelector('.texto-conteudo');
        // mostrando a nota
        angular.element(nota).toggleClass('esconder-conteudo');
        angular.element(notaTitulo).toggleClass('esconder-conteudo');
        angular.element(notaTexto).toggleClass('esconder-conteudo');
        // Deixando o botão visivel
        angular.element(botaoNota).toggleClass('mostrar-botao');
      });

    }

  }
})
