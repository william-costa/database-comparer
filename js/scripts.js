$(document).ready(function(){

  //COPIA CHAVES DE BANCO A PARA B
  $(document).on('click','span.copiarChaves', function(){
    var servidor = $('input[name="bd[servidor]"]').val();
    var porta = $('input[name="bd[porta]"]').val();
    var usuario  = $('input[name="bd[usuario]"]').val();
    var senha    = $('input[name="bd[senha]"]').val();

    $('input[name="bd2[servidor]"]').val(servidor);
    $('input[name="bd2[porta]"]').val(porta);
    $('input[name="bd2[usuario]"]').val(usuario);
    $('input[name="bd2[senha]"]').val(senha);
  });


  $('.preset').on('change', function() {
    var selectedValue = $(this).val();
    if(selectedValue == ''){
      $(this).closest('fieldset').find('input[type="text"], input[type="password"], span, br').show();
    }else{
      $(this).closest('fieldset').find('input[type="text"], input[type="password"], span, br').hide();
    }
});
});
