angular.module("Notas")
.factory("NotasFactory", function NotaFactory($http) {
  return {
    validarLogin: function(dados) {
      return $http({
        method: "POST",
        url: "php/Controllers/Controle.php?op=validarLogin",
        data: dados,
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
    },
    enviarNota: function(nota) {
      return $http({
        method: "POST",
        url: "php/Controllers/Controle.php?op=enviarNota",
        data: nota,
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
    },
    buscarNotas: function(codigoUsuario) {
      return $http({
        method: "POST",
        url: "php/Controllers/Controle.php?op=buscarNotas",
        data: { codigoUsuario:codigoUsuario },
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
    },
    buscarNota: function(codigo) {
      return $http({
        method: "POST",
        url: "php/Controllers/Controle.php?op=buscarNota",
        data: { codigo: codigo },
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
    },
    buscarCategorias: function() {
      return $http({
        method: "GET",
        url: "php/Controllers/Controle.php?op=buscarCategorias",
        // headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
    },
    buscarUsuarios: function() {
      return $http({
        method: "GET",
        url: "php/Controllers/Controle.php?op=buscarUsuarios",
        // headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
    },
    buscarNotaEditar: function(codigo) {
      return $http({
        method: "POST",
        url: "php/Controllers/Controle.php?op=buscarNotaEditar",
        data: { codigo: codigo },
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
    },
    atualizarNota: function(nota) {
      return $http({
        method: "POST",
        url: "php/Controllers/Controle.php?op=atualizarNota",
        data: nota,
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
    },
    deletarNota: function(dados) {
      return $http({
        method: "POST",
        url: "php/Controllers/Controle.php?op=deletarNota",
        data: dados,
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
    },
    cadastrarUsuario: function(dados) {
      return $http({
        method: "POST",
        url: "php/Controllers/Controle.php?op=cadastrarUsuario",
        data: dados,
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
    },
  }
});
