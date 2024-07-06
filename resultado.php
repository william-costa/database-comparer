<?php
/**
 * Arquivo responsável pela tela de resultado da comparação
 *
 * @package     Base
 * @subpackage  Resultado
 * @name        BaseResultado
 * @version     1.0
 * @copyright   Webart
 * @author      William Costa
 *
 */

 ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml">
 <head>
 <title>Resultado > Comparador de banco de dados</title>
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 <meta name="format-detection" http-equiv="Content-Type" content="text/html; charset=utf-8; telephone=no" />

 <style>
   html,body{
     font-family:arial;
   }
   fieldset{
       width:400px;
   }
   .bancoA{
     color:#27ae60;
   }
   .bancoB{
     color:#c0392b;
   }
 </style>

 </head>
 <body>
 <h1>Comparador de banco de dados | resultado</h1>

  Banco A: <strong><?=$_POST['bd']['banco'].'</strong> ('.$_POST['bd']['servidor'].')'?><br>
  Banco B: <strong><?=$_POST['bd2']['banco'].'</strong> ('.$_POST['bd2']['servidor'].')'?><br><br>

  <fieldset>
    <legend>Tabelas únicas em Banco A</legend>
    <ul  class="bancoA">
    <?php
       foreach($analise['analiseTabelasAB'] as $key=>$value){
         echo '<li><strong>'.$value.'</strong></li>';
       }
     ?>
   </ul>
  </fieldset>
 <br><br>
  <fieldset>
    <legend>Tabelas únicas em Banco B</legend>
    <ul  class="bancoB">
    <?php
       foreach($analise['analiseTabelasBA'] as $key=>$value){
         echo '<li><strong>'.$value.'</strong></li>';
       }
     ?>
    </ul>
  </fieldset>
 <br><br>
 <fieldset>
   <legend>Alteração de colunas</legend>
   <ul>
   <?php
      if(empty($analise['analiseColunasAB'])){
        echo '<li class="bancoA"><strong>Não há alterações de colunas</strong></li>';
      }else
      foreach($analise['analiseColunasAB'] as $key=>$value){
        echo '<li><strong>'.$key.'</strong><ul>';

           echo '<li class="bancoA">Colunas únicas em <strong>Banco A</strong><ul>';
             if(empty($value['a'])){
               echo '<li><strong>Não há colunas únicas nesta tabela do Banco A</strong></li>';
             }else
             foreach($value['a'] as $key2=>$value2){
               echo '<li><strong>'.$key2.'</strong></li>';
             }
           echo '</ul></li>';

           echo '<li  class="bancoB">Colunas únicas em <strong>Banco B</strong><ul>';
             if(empty($value['b'])){
               echo '<li><strong>Não há colunas únicas nesta tabela do Banco B</strong></li>';
             }else
             foreach($value['b'] as $key2=>$value2){
               echo '<li><strong>'.$key2.'</strong></li>';
             }
           echo '</ul></li>';

           echo '<li>Colunas alteradas<ul>';
           if(empty($value['dif'])){
             echo '<li><strong>Não há colunas alteradas nesta tabela</strong></li>';
           }else
             foreach($value['dif'] as $key2=>$value2){
               echo '<li><strong>'.$key2.'</strong><ul>';

                 echo '<li  class="bancoA"><strong>Banco A</strong><ul>';
                   foreach($value2['a'] as $key3=>$value3){
                     echo '<li>'.$key3.' = <strong>'.$value3.'</strong></li>';
                   }
                 echo '</ul></li>';

                 echo '<li  class="bancoB"><strong>Banco B</strong><ul>';
                   foreach($value2['b'] as $key3=>$value3){
                     echo '<li>'.$key3.' = <strong>'.$value3.'</strong></li>';
                   }
                 echo '</ul></li>';

               echo '</ul></li>';
             }
           echo '</ul></li>';

        echo '</ul></li>';
      }
    ?>
  </ul>
 </fieldset>
 <br><br>

 <fieldset>
   <legend>Resultado</legend>
    <h2><?=$analise['resultado']?></h2>
 </fieldset>



 </body>
