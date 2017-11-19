// Efeito fadeIn / fadeOut  nas fotos

$(function(){

  //Seleciona os links que tenham a classe .galeria
  $('a.galeria').bind('click', function(){
            // Seleciona o link <a>, acha a imagem, coleta o endereço contido no atributo src
    var img = $(this).find('img').attr('src');

    // Aplicar a imagem selecionada na div que contém a classe .fotobox
    $('.fotobox img').attr('src', img);

    //Mostrar a foto na tela com o efeito fadeIn
    $('.bgbox, .fotobox').fadeIn('low');
  });

  // Aplica o efeito de fadeOut ao clicar na foto
  $('.bgbox, .fotobox').bind('click', function(){

    $('.bgbox, .fotobox').fadeOut('low');

  });


});
