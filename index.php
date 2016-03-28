<?php
/**
 * Arquivo principal do sistema de comparação de estruturas de banco de dados
 *
 * @package     Base
 * @subpackage  Index
 * @name        BaseIndex
 * @version     1.0
 * @copyright   Webart
 * @author      William Costa
 *
 */

include('includes.php');

if($_POST){
  $Funcoes = new Funcoes;
  $Funcoes->setBancoA($_POST['bd']);
  $Funcoes->setBancoB($_POST['bd2']);
  $analise = $Funcoes->getAnalise();
  include(dirname(__FILE__).'/resultado.php');
}else{
  include(dirname(__FILE__).'/formulario.php');
}


 ?>
