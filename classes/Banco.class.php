<?php
/**
 * Classe sem métodos nem atributos utilizada para se conectar ao banco de dados
 *
 * @package     Classe
 * @subpackage  Banco
 * @name        ClasseBanco
 * @version     1.0
 * @copyright   Webart
 */


class Banco{


    // conexao sera compartilhada entre todas as instâncias
    public $conexao;


    /*
     * Método construtor
     * Se conexão não existir, cria, senão, nada a fazer (reutiliza a criada por outra
     * instância da classe Tabela
     */
    function __construct() {
      global $bdconfig;
      if (!$this->conexao){
  		 $this->conexao = new mysqli ($bdconfig['servidor'],
                                                        $bdconfig['usuario'],
                                                        $bdconfig['senha'],
                                                        $bdconfig['banco']);
  	}


  	/* Mudança de character set para utf8 */
  	mysqli_set_charset($this->conexao, "utf8");

    } // function __construct


    /*
     * Método execSQL
     * Executa uma consulta através da conexão estabelecida
     * Se o debug estiver ativado (variável $debug=true em config.inc.php exibe SQL
     * Retorna um objeto com o resultado da consulta
     */
  	function execSQL($sql)
  	{
      global $debugBanco;

      // Executa a consulta através da conexão
      $resultado = $this->conexao->query($sql);

      // Se debug ativado, exibe SQL na tela
      if ($debugBanco) echo "<pre>$sql</pre><hr>";

      // Se resultado existe, retorna resultado
      if ($resultado) {
        return $resultado;
      // Senão, exibe erro do MySQL e aborta script
      } else {

  	  global $debugBancoMostraErro;
  	  if($debugBancoMostraErro) {echo $this->conexao->error;} else {echo 'Você não tem permissão para fazer isso! Acesso ao DB Negado.';}
        exit;
      }
    } // function execSQL

}

 ?>
