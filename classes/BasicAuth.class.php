<?php
/**
* Classe responsável por gerenciar autenticação Basic Auth do Navegador
*
* @author William Costa
*
*/

class BasicAuth{

  /**
   * Método responsável por iniciar o stema de basic auth
   *
   * @return void
   */
  public static function init(){
    if(Config::get('basicAuth.ativo',false)){
      self::require(Config::get('basicAuth.usuario',''),Config::get('basicAuth.senha',''));
    }
  }

  /**
   * Método responsável por obrigar o login via basic auth para acessar
   *
   * @param  string $user
   * @param  string $pass
   * @return void
   */
  public static function require($user,$pass){
    header('Cache-Control: no-cache, must-revalidate, max-age=0');
    $credenciais = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));
    if (!$credenciais || $_SERVER['PHP_AUTH_USER'] != $user || $_SERVER['PHP_AUTH_PW'] != $pass) {
      header('HTTP/1.1 401 Authorization Required');
      header('WWW-Authenticate: Basic realm="Access denied"');
      exit;
    }
  }


}