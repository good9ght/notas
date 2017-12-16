angular.module("Notas")
.factory("NotasFactory", function NotaFactory($http) {
  return {
    validarLogin: function(dados) {
      return $http({
        method: "POST",
        url: "app/php/Controllers/UsuariosController.php?op=validarLogin",
        data: dados,
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
    },
    cadastrarUsuario: function(dados) {
      return $http({
        method: "POST",
        url: "app/php/Controllers/UsuariosController.php?op=cadastrarUsuario",
        data: dados,
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
    },
    buscarUsuarios: function() {
      return $http({
        method: "GET",
        url: "app/php/Controllers/UsuariosController.php?op=buscarUsuarios",
      });
    },
    enviarNota: function(nota) {
      return $http({
        method: "POST",
        url: "app/php/Controllers/NotasController.php?op=enviarNota",
        data: nota,
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
    },
    buscarNotas: function(codigoUsuario) {
      return $http({
        method: "POST",
        url: "app/php/Controllers/NotasController.php?op=buscarNotas",
        data: { autor:codigoUsuario },
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
    },
    buscarNota: function(codigo) {
      return $http({
        method: "POST",
        url: "app/php/Controllers/NotasController.php?op=buscarNota",
        data: { codigo: codigo },
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
    },
    buscarCategorias: function() {
      return $http({
        method: "GET",
        url: "app/php/Controllers/NotasController.php?op=buscarCategorias",
      });
    },
    atualizarNota: function(nota) {
      return $http({
        method: "POST",
        url: "app/php/Controllers/NotasController.php?op=atualizarNota",
        data: nota,
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
    },
    deletarNota: function(dados) {
      return $http({
        method: "POST",
        url: "app/php/Controllers/NotasController.php?op=deletarNota",
        data: dados,
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
    }
  }
});
