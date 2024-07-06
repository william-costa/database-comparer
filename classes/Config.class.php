<?php
/**
 * Classe responsável pelo gerenciamento das configs do projeto
 *
 * @package     Classe
 * @name        Config
 * @version     1.1
 */


class Config {

  /**
   * Configurações
   *
   * @var array
   */
  private static $configs = [];

  /**
   * Método responsável por carrear as configurações
   *
   * @return void
   */
  public static function init(){
    if(file_exists(ROOT.'/config.json')){
      self::$configs = json_decode(file_get_contents(ROOT.'/config.json'),true);
    }
  }

  /**
   * Método responsável por retornar uma config 
   *
   * @param  string $hash
   * @return mixed
   */
  public static function get($hash,$defaultValue = null){
    $xHash = explode('.',trim($hash,'.'));
    $configs = self::$configs;
    foreach($xHash as $level){
      if(isset($configs[$level])){
        $configs = $configs[$level];
        continue;
      }
      return $defaultValue;
    }
    return $configs;
  }

}