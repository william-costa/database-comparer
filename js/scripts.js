$(document).ready(function(){

  //COPIA CHAVES DE BANCO A PARA B
  $(document).on('click','span.copiarChaves', function(){
    var servidor = $('input[name="bd[servidor]"]').val();
    var usuario  = $('input[name="bd[usuario]"]').val();
    var senha    = $('input[name="bd[senha]"]').val();

    $('input[name="bd2[servidor]"]').val(servidor);
    $('input[name="bd2[usuario]"]').val(usuario);
    $('input[name="bd2[senha]"]').val(senha);
  });
});
