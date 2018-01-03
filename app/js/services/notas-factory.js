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
      return $http.get("app/php/Controllers/UsuariosController.php",
       { params: { op:"buscarUsuarios" }});
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
      return $http.get("app/php/Controllers/NotasController.php",
       { params: { op:"buscarNotas", codigo:codigoUsuario }});
    },
    buscarNota: function(codigo) {
      return $http.get("app/php/Controllers/NotasController.php",
       { params: { op:"buscarNota", codigo:codigo }});
    },
    buscarCategorias: function() {
      return $http.get("app/php/Controllers/NotasController.php",
       { params: { op:"buscarCategorias" }});
    },
    atualizarNota: function(nota) {
      return $http({
        method: "POST",
        url: "app/php/Controllers/NotasController.php?op=atualizarNota",
        data: nota,
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
    },
    deletarNota: function(codigoNota) {
      return $http.delete("app/php/Controllers/NotasController.php",
      { params:{ op:"deletarNota", codigo:codigoNota }});
    }
  }
});
