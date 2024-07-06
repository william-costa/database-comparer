<?php
/**
 * Classe responsável pelo gerenciamento dos presets de banco
 *
 * @package     Classe
 * @name        Preset
 * @version     1.1
 */


class Preset {

  /**
   * Método responsável por obter todos os presets
   *
   * @return array
   */
  public static function getPresets(){
    return Config::get('presets',[]);
  }

  /**
   * Método responsável por obter um preset
   *
   * @param  integer $id
   * @return array
   */
  public static function getPreset($id){
    $presets = self::getPresets();
    return [
      'titulo'   => $presets[$id]['titulo'] ?? '',
      'servidor' => $presets[$id]['servidor'] ?? '',
      'porta'    => $presets[$id]['porta'] ?? '',
      'usuario'  => $presets[$id]['usuario'] ?? '',
      'senha'    => $presets[$id]['senha'] ?? '',
      'banco'    => $presets[$id]['banco'] ?? '',
    ];
  }

}