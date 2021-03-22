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
    <title>Comparador Banco de Dados</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="format-detection" http-equiv="Content-Type" content="text/html; charset=utf-8; telephone=no" />
    <link rel="icon" type="image/png" href="favicon.ico">
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/resultado.css">

  </head>

  <body>
    <div class="content">
      <h2>Resultado: <?= $analise['resultado'] ?></h2>
      <hr>
      <h4>Banco A: <strong><?= $_POST['bd']['banco']  . '</strong>(' . $_POST['bd']['servidor']  . ')' ?></h4>
      <h4>Banco B: <strong><?= $_POST['bd2']['banco'] . '</strong>(' . $_POST['bd2']['servidor'] . ')' ?></h4>
      <hr>
      <div class="card">
        <div class="card-header">
          <h3>Tabelas únicas em Banco A</h3>
        </div>
        <div class="card-body">
          <ul class="bancoA">
            <?php
              foreach ($analise['analiseTabelasAB'] as $key => $value) {
                echo '<li><strong>' . $value . '</strong></li>';
              }
            ?>
          </ul>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h3>Tabelas únicas em Banco B</h3>        
        </div>
        <div class="card-body">
          <ul class="bancoB">
            <?php
              foreach ($analise['analiseTabelasBA'] as $key => $value) {
                echo '<li><strong>' . $value . '</strong></li>';
              }
            ?>
          </ul>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h3>Alteração de colunas</h3>
        </div>
        <div class="card-body">
          <ul>
            <?php
              if (empty($analise['analiseColunasAB'])) {
                echo '<li class="bancoA"><strong>Não há alterações de colunas</strong></li>';
              } else
              foreach ($analise['analiseColunasAB'] as $key => $value) {
                echo '<li><strong>' . $key . '</strong><ul>';
                echo '<li class="bancoA">Colunas únicas em <strong>Banco A</strong><ul>';
                if (empty($value['a'])) {
                  echo '<li><strong>Não há colunas únicas nesta tabela do Banco A</strong></li>';
                } else
                foreach ($value['a'] as $key2 => $value2) {
                  echo '<li><strong>' . $key2 . '</strong></li>';
                }
                echo '</ul></li>';

                echo '<li  class="bancoB">Colunas únicas em <strong>Banco B</strong><ul>';
                if (empty($value['b'])) {
                  echo '<li><strong>Não há colunas únicas nesta tabela do Banco B</strong></li>';
                } else
                  foreach ($value['b'] as $key2 => $value2) {
                    echo '<li><strong>' . $key2 . '</strong></li>';
                  }
                  echo '</ul></li>';

                  echo '<li>Colunas alteradas<ul>';
                  if (empty($value['dif'])) {
                    echo '<li><strong>Não há colunas alteradas nesta tabela</strong></li>';
                  } else
                    foreach ($value['dif'] as $key2 => $value2) {
                      echo '<li><strong>' . $key2 . '</strong><ul>';

                      echo '<li  class="bancoA"><strong>Banco A</strong><ul>';
                      foreach ($value2['a'] as $key3 => $value3) {
                        echo '<li>' . $key3 . ' = <strong>' . $value3 . '</strong></li>';
                      }
                      echo '</ul></li>';

                      echo '<li  class="bancoB"><strong>Banco B</strong><ul>';
                      foreach ($value2['b'] as $key3 => $value3) {
                        echo '<li>' . $key3 . ' = <strong>' . $value3 . '</strong></li>';
                      }
                      echo '</ul></li>';
                      echo '</ul></li>';
                      }
                    echo '</ul></li>';
                    echo '</ul></li>';
                  }
              ?>
          </ul>
        </div>
      </div>
    </div>    
    <!-- BOOTSTRAP JS -->
  <script src="js/jquery-1-2-12.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
  </body>
</html>