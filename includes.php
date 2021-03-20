<?php
/**
 * Arquivo responsável pelo autoload de classes e include dos arquivos necessários
 *
 * @package     Base
 * @subpackage  Includes
 * @name        BaseIncludes
 * @version     1.0
 * @copyright   Webart
 * @author      William Costa
 *
 */

function __autoload($classe){
	include_once( 'classes/'.$classe .'.class.php' );
}
 ?>
