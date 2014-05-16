$(document).ready(function(){
    $.getJSON('get_categorias', 
        function(categorias){
            for(i = 0; i < categorias.length; i++){
                json_categoria = categorias[i];
                categoria = $('<div>').addClass('categoria');
                categoria.append($('<h3>').text(json_categoria.nombre));
                categoria.append($('<img>').addClass('img-circle').attr('src', json_categoria.imagen));
                categoria.appendTo($('#categorias'));
            }
        });       
});

