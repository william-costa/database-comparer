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
  <title>Resultado > Comparador de banco de dados</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="format-detection" http-equiv="Content-Type" content="text/html; charset=utf-8; telephone=no" />
  <link rel="icon" type="image/png" href="favicon.ico">
  <!-- BOOTSTRAP CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  

  <style>
    html,
    body {
      font-family: arial;
    }

    fieldset {
      width: 300px;
    }

    fieldset.bd2 .copiarChaves {
      float: right;
      padding: 10px;
      font-size: 11px;
      font-weight: bold;
      color: blue;
      cursor: pointer;
    }
    fieldset.bd2 .copiarChaves:hover {
      text-decoration: underline;
    }
    .card-custom{
      width: 400px;
    }    
    .btn-container{
      padding: 10px 0 0 0;
    }
    .btn-container button{
      margin: 0 2px 0 2px;
    }
    .alert, .send-button{
      width: 400px;
    }
    .content{
      width: 800px;
      margin: auto;
      text-align: center;
      align-content: center;
    }
    .content form{
      display: inline-block;
    }
  </style>

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
        <button class="btn btn-primary btn-block" type="button">Comparar</button>
      </div>
    </form>
  </div>
  <script src="js/jquery-1-2-12.js"></script>
  <script src="js/scripts.js"></script>
  <!-- BOOTSTRAP JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
  <script>
    $(".copiarChaves").click(function(){
      var servidor = $('input[name="bd[servidor]"]').val();
      var usuario  = $('input[name="bd[usuario]"]').val();
      var porta    = $('input[name="bd[porta]"]').val();
      var senha    = $('input[name="bd[senha]"]').val();

      $('input[name="bd2[servidor]"]').val(servidor);
      $('input[name="bd2[porta]"]').val(porta);
      $('input[name="bd2[usuario]"]').val(usuario);
      $('input[name="bd2[senha]"]').val(senha);
    });

    $("#salvar-favorito").click((e)=>{
      e.preventDefault();
      let continueTest = true;
      if($('input[name="bd[servidor]"]').val().trim() == ""){
        alertBox("Campo Servidor em branco","warning",4000);
        continueTest = false;
      }
      if($('input[name="bd[porta]"]').val().trim() == ""){
        alertBox("Campo Porta em branco","warning",4000);
        continueTest = false;
      }
      if($('input[name="bd[senha]"]').val().trim() == ""){
        alertBox("Campo Senha em branco","warning",4000);
        continueTest = false;
      }
      if($('input[name="bd[banco]"]').val().trim() == ""){
        alertBox("Campo Banco em branco","warning",4000);
        continueTest = false;
      }
      if(continueTest){
        $.ajax({
          url: "<?= dirname(".") ?>",
          type:"POST",
          data:{
            salvar:"true",
            host: $('input[name="bd[servidor]"]').val(),
            port: $('input[name="bd[porta]"]').val(),
            user: $('input[name="bd[usuario]"]').val(),
            password: $('input[name="bd[senha]"]').val(),
            database: $('input[name="bd[banco]"]').val(),
          },        
          success:function(data){
            alertBox("Favorito salvo com sucesso!</a>","success");
          },
          error:function(data){
            alertBox("Não foi possível gravar o favorito. Tente liberar permissão na pasta do comparador <a href= class='alert-link'>sudo chmod -R 777</a>","danger");
          }
        });
      }
      
    })
    $("#carregar-favorito").click((e)=>{
      e.preventDefault();
      $.ajax({
        url: "<?= dirname(".") ?>",
        type:"POST",
        data:{carregar:"true"},
        success:function(data){
          data = JSON.parse(data);
          if(data.host == "" && data.port == "" && data.user == "" && data.password == "" && data.database == ""){
            alertBox("Registro não encontrado. Use o botão Salvar para cirar um novo registro","danger");
          }else{
            $('input[name="bd[servidor]"]').val(data.host);
            $('input[name="bd[porta]"]').val(data.port);
            $('input[name="bd[usuario]"]').val(data.user);
            $('input[name="bd[senha]"]').val(data.password);
            $('input[name="bd[banco]"]').val(data.database);
          }
        }
      });
    })

    $("#limpar-campos").click((e)=>{
      e.preventDefault();
      $('input[name="bd[servidor]"]').val("");
      $('input[name="bd[porta]"]').val("");
      $('input[name="bd[usuario]"]').val("");
      $('input[name="bd[senha]"]').val("");
      $('input[name="bd[banco]"]').val("");
    })

    $("#limpar-campos2").click((e)=>{
      e.preventDefault();
      $('input[name="bd2[servidor]"]').val("");
      $('input[name="bd2[porta]"]').val("");
      $('input[name="bd2[usuario]"]').val("");
      $('input[name="bd2[senha]"]').val("");
      $('input[name="bd2[banco]"]').val("");
    })


    function alertBox(message,type,delayTime = 2000,fadeOutTime = 1000){
      let continueTest = true;
      $(".alert").map((inde,alertBoxElement)=>{
        if(alertBoxElement.innerText == message + "\n×"){
          continueTest = false;
        }
      })
      if(continueTest){
        let alertHtmlBox = document.createElement("div");
        alertHtmlBox.innerHTML += message;
        alertHtmlBox.innerHTML += `
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>`;
        alertHtmlBox.classList.add("alert");
        alertHtmlBox.classList.add("alert-" + type);
        $(alertHtmlBox).delay(delayTime).fadeOut(fadeOutTime,function(){
          $(alertHtmlBox).remove();
        });
        $("h1").after(alertHtmlBox);
      }
    }
  </script>
</body>