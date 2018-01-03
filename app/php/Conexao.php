<?php

  class Conexao extends PDO {
    const DSN = "mysql:dbname=notas;host:127.0.0.1"; // Data Name Source
    const USUARIO = "root";
    const SENHA = "";

    private static $instancia = null;

    function Conexao($dsn, $usuario, $senha) {
      parent:: __construct($dsn, $usuario, $senha);
    }

    static function getInstancia() {
      try{
        self::$instancia = new Conexao(self::DSN, self::USUARIO, self::SENHA);
      }
      catch (Exception $erroSql) {
        echo "Erro ao Conectar";
        exit();
      }
      return self::$instancia;
    }
  }
