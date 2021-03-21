<?php
  /**
  * Arquivo responsável pela tela de formulario para indicação dos bancos de
  * dados a serem comparados
  *
  * @package     Base
  * @subpackage  Formulario
  * @name        BaseFormulario
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

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="css/formulario.css">

</head>

<body>
  <div class="content">
    <h1>Comparador de banco de dados</h1>
    <form method="post">
      <div class="card card-custom">
        <div class="card-header">
          <h3>Banco A</h3>
        </div>
        <div class="card-body">
          <input class="form-control" type="text"     name="bd[servidor]" placeholder="Servidor">
          <input class="form-control" type="text"     name="bd[porta]"    placeholder="Porta"   >
          <input class="form-control" type="text"     name="bd[usuario]"  placeholder="Usuário">
          <input class="form-control" type="password" name="bd[senha]"    placeholder="Senha">
          <input class="form-control" type="text"     name="bd[banco]"    placeholder="Banco">
          <div class="btn-container">
            <button class="btn btn-warning" id="salvar-favorito">
              <i class="fa fa-star"></i> Salvar
            </button>
            <button class="btn btn-success" id="carregar-favorito">
              <i class="fa fa-floppy-o"></i> Carregar
            </button>
            <button class="btn btn-danger"  id="limpar-campos">
              <i class="fa fa-times"></i> Limpar
            </button>
          </div>
        </div>
      </div>
      <br>
      <div class="card card-custom">
        <div class="card-header">
          <h3>Banco B</h3>
        </div>
        <div class="card-body">
          <span class="copiarChaves" title="Copia os dados de acesso do Banco A para o Banco B"><a href="javascript:void(0)">Copiar chaves do Banco A</a></span>
          <input class="form-control" type="text"     name="bd2[servidor]" placeholder="Servidor">
          <input class="form-control" type="text"     name="bd2[porta]"    placeholder="Porta"   >
          <input class="form-control" type="text"     name="bd2[usuario]"  placeholder="Usuário">
          <input class="form-control" type="password" name="bd2[senha]"    placeholder="Senha">
          <input class="form-control" type="text"     name="bd2[banco]"    placeholder="Banco">
          <div class="btn-container">
            <button class="btn btn-danger"  id="limpar-campos2">
              <i class="fa fa-times"></i> Limpar
            </button>
          </div>
        </div>
      </div>
      <br>
      <div class="send-button">
        <button class="btn btn-primary btn-block" type="submit">Comparar</button>
      </div>
    </form>
  </div>
  <script src="js/jquery-1-2-12.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
</body>