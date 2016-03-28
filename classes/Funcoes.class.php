<?php
/**
 * Classe responsável por executar a comparação das estruturadas dos bancos de dados
 *
 * @package     Classe
 * @subpackage  Funcoes
 * @name        ClasseFuncoes
 * @version     1.0
 * @copyright   Webart
 * @author      William Costa
 *
 */

class Funcoes{

  //DADOS DOS BANCOS A E B
  private $bancoA = null;
  private $bancoB = null;

  //TODAS AS TABELAS DOS BANCOS A E B
  private $tabelasA = null;
  private $tabelasB = null;

  //TODAS AS COLUNAS DOS BANCOS A E B
  private $colunasA = null;
  private $colunasB = null;

  //ANALISE DE TABELAS ÚNICAS DOS BANCOS A E B
  private $analiseTabelasAB = null;
  private $analiseTabelasBA = null;

  //ANALISE COMPLETA DE COLUNAS ÚNICAS E ALTERADAS NOS BANCOS A E B
  private $analiseColunasAB = array();

  //VARIÁVEIS QUE RECEBE O ESTADO DE IGUALDADE DAS ESTRUTURAS DOS BANCOS
  private $resultadoBancoA  = true;
  private $resultadoBancoB  = true;
  private $resultadoColunas = true;

  //MÉTODO SET DAS INFORMAÇÕES DO BANCO A ENVIADAS POR POST
  public function setBancoA($bd){
    $this->bancoA = $bd;
  }

  //MÉTODO SET DAS INFORMAÇÕES DO BANCO B ENVIADAS POR POST
  public function setBancoB($bd){
    $this->bancoB = $bd;
  }

  //MÉTODO GET BANCO A RETORNA UM OBJETO CARREGADO COM AS INFORMAÇÕES DO BANCO A
  public function getBancoA(){
    global $bdconfig;
    $bdconfig = $this->bancoA;
    return new Banco;
  }

  //MÉTODO GET BANCO B RETORNA UM OBJETO CARREGADO COM AS INFORMAÇÕES DO BANCO B
  public function getBancoB(){
    global $bdconfig;
    $bdconfig = $this->bancoB;
    return new Banco;
  }

  //MÉTODO GET ANALISE EXECUTA OS MÉTODOS DE ANÁLISES ESTRUTURAIS DE TABELAS E COLUNAS E OBTEM O RETORNO DA ANALISE
  public function getAnalise(){
    $this->getAnaliseTabelas();
    $this->getAnaliseColunas();
    return $this->getRetorno();
  }

  //MÉTODO DE ANÁLISE DE TABELASS
  public function getAnaliseTabelas(){

      //OBTEM OS OBJETOS
      $obA = $this->getBancoA();
      $obB = $this->getBancoB();

      //SQL PARA MOSTRAR AS TABELAS
      $sql = 'SHOW TABLES;';

      //EXECUÇÃO DAS QUERIES
      $resA = $obA->execSQL($sql);
      $resB = $obB->execSQL($sql);

      //AUXILIARES
      $auxA = array();
      $auxB = array();

      //NOME DO CAMPO RETORNADO NA SQL A
      $data = 'Tables_in_'.$this->bancoA['banco'];

      //LAÇO PARA ATRIBUIR OS NOMES DAS TABELAS DO BANCO A AO AUXILIAR A
      while($lineA = $resA->fetch_object()){
        $auxA[] = $lineA->$data;
      }

      //NOME DO CAMPO RETORNADO NA SQL B
      $data = 'Tables_in_'.$this->bancoB['banco'];

      //LAÇO PARA ATRIBUIR OS NOMES DAS TABELAS DO BANCO B AO AUXILIAR B
      while($lineB = $resB->fetch_object()){
        $auxB[] = $lineB->$data;
      }

      //ATRIBUIÇÃO DOS VALORES ÀS VARIÁVEIS DA CLASSE
      $this->tabelasA = $auxA;
      $this->tabelasB = $auxB;

      //OBTENDO A ANÁLISE DE DIFERENÇAS
      $resAB = array_diff_assoc($auxA, $auxB);
      $resBA = array_diff_assoc($auxB, $auxA);

      //ATRIBUINDO A ANÁLISE ÀS VARIÁVEIS DA CLASSE
      $this->analiseTabelasAB = $resAB;
      $this->analiseTabelasBA = $resBA;

      $this->resultadoBancoA = empty($resAB)?true:false;
      $this->resultadoBancoB = empty($resBA)?true:false;

  }

  //MÉTODO DE ANÁLISE ESTRUTURAL DAS COLUNAS DE CADA TABELA DOS BANCOS
  public function getAnaliseColunas(){

    //OBTEM OS OBJETOS DOS BANCOS A E B
    $obA = $this->getBancoA();
    $obB = $this->getBancoB();

    //SQL PARA MOSTRAR AS COLUNAS
    $sql = 'SHOW COLUMNS FROM ';

    //OBTENDO AS TABELAS SALVAS NAS VARIÁVEIS PELO MÉTODO ANTERIOR
    $tabelasA = $this->tabelasA;
    $tabelasB = $this->tabelasB;

    //OBTEM SOMENTE AS TABELAS QUE ESTIVEREM NA INTERSECÇÃO DOS DOIS BANCOS
    $tabelasAB = array_intersect_assoc($tabelasA,$tabelasB);

    //PRIMEIRO LAÇO PARA ANDAR PELAS TABELAS
    foreach($tabelasAB as $key=>$value){

      //AUXILIARES
      $auxA = array();
      $auxB = array();

      //EXECUÇÃO DAS QUERIES PARA OBTER OS CAMPOS
      $resA = $obA->execSQL($sql.$value);
      $resB = $obB->execSQL($sql.$value);

      //SEGUNDO LAÇO PARA ATRIBUIR OS CAMPOS DA TABELA DO BANCO A AO AUXILIAR A
      while($lineA = $resA->fetch_assoc()){
        $auxA[$lineA['Field']] = $lineA;
      }

      //TERCEIRO LAÇO PARA ATRIBUIR OS CAMPOS DA TABELA DO BANCO B AO AUXILIAR B
      while($lineB = $resB->fetch_assoc()){
        $auxB[$lineB['Field']] = $lineB;
      }

      //OBTENDO OS CAMPOS ÚNICOS
      $difCamposAB = array_diff_assoc($auxA,$auxB);
      $difCamposBA = array_diff_assoc($auxB,$auxA);

      //OBTENDO OS CAMPOS QUE ESTIVEREM NA INTERSECÇÃO DOS DOIS BANCOS
      $camposAB = array_intersect_assoc($auxA,$auxB);

      //QUARTO LAÇO PARA DESCOBRIR CAMPOS QUE ESTIVEREM DIFERENTES NOS DOIS BANCOS
      foreach($camposAB as $key2=>$value2){
        if($auxA[$key2] != $auxB[$key2]){
          $altCamposAB[$key2]['a'] = $auxA[$key2];
          $altCamposAB[$key2]['b'] = $auxB[$key2];
        }
      }

      //ATRIBUIÇÃO DAS VARIÁVEIS DA CLASSE
      $this->analiseColunasAB[$value]['a'] = $difCamposAB;
      $this->analiseColunasAB[$value]['b'] = $difCamposBA;
      $this->analiseColunasAB[$value]['dif'] = $altCamposAB;

      if((!empty($difCamposAB)) OR (!empty($difCamposBA)) OR (!empty($altCamposAB))) $this->resultadoColunas = false;

    }

  }

  //MÉTODO PARA RETORNAR UM ARRAY CONTENDO AS INFORMAÇÕES DA ANÁLISE PARA SEREM EXIBIDAS NO ARQUIVO DE RESULTADO
  public function getRetorno(){
    $retorno = array();
    if(!$this->resultadoBancoA) $retorno['analiseTabelasAB'] = $this->analiseTabelasAB;
    else{
      $retorno['analiseTabelasAB'][] = 'Não há tabelas únicas no Banco A';
      $bancoA = true;
    }

    if(!$this->resultadoBancoB) $retorno['analiseTabelasBA'] = $this->analiseTabelasBA;
    else{
      $retorno['analiseTabelasBA'][] = 'Não há tabelas únicas no Banco B';
      $bancoB = true;
    }

    if(!$this->resultadoColunas) $retorno['analiseColunasAB'] = $this->analiseColunasAB;
    else{
      $colunas = true;
    }

    if($bancoA AND $bancoB AND $colunas){
      $retorno['resultado'] = 'Bancos estruturalmente iguais.';
    }else{
      $retorno['resultado'] = 'Os bancos apresentam diferenças estruturais.';
    }

    return $retorno;
  }

}

 ?>
