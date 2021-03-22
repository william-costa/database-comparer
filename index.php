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

if(isset($_POST['bd'])){
  $Funcoes = new Funcoes;
  $Funcoes->setBancoA($_POST['bd']);
  $Funcoes->setBancoB($_POST['bd2']);
  $analise = $Funcoes->getAnalise();
  include(dirname(__FILE__).'/resultado.php');
}else if(isset($_POST['salvar'])){
  echo Funcoes::setArquivo($_POST['host'],$_POST['port'],$_POST['user'],$_POST['password'],$_POST['database']);
}else if(isset($_POST['carregar'])){
  echo Funcoes::getArquivo();
}
else{
  include(dirname(__FILE__).'/formulario.php');
}


 ?>
