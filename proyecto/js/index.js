$(document).ready(function(){
    $.getJSON('get_categorias', 
        function(categorias){
            for(i = 0; i < categorias.length; i++){
                json_categoria = categorias[i];
                categoria = $('<div>').addClass('categoria');
                categoria.append($('<h3>').text(json_categoria.nombre));
                categoria.append($('<img>').addClass('img-circle').attr('src', json_categoria.imagen));

                categoria.click(function(){
                    nombre = $(this).find('h3').text();
                    imagen = $(this).find('img').attr('src');
                    modal = $("#modalcategoria");
                    modal.find(".modal-body").html(""); // Vacío el contenido anterior
                    modal.find(".modal-header h4").text(nombre);
                    modal.find(".modal-body").append($("<img>").attr("src",imagen));
                    modal.modal();
                })
                categoria.appendTo($('#categorias'));
            }
        });       
});

