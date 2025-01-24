jQuery(document).ready(function($){
    $('#print-points').on('click', function(){
        var points = prompt("Ingrese la cantidad de puntos a imprimir:");
        if(points != null && points != ""){
            $.ajax({
                url: ajaxurl,
                method: 'POST',
                data: {
                    action: 'print_points',
                    points: points
                },
                success: function(response) {
                    if(response.success){
                        alert("Puntos impresos correctamente");
                    } else {
                        alert("Error al imprimir puntos");
                    }
                }
            });
        }
    });

    $('#generate-token').on('click', function(){
        var points = prompt("Ingrese la cantidad de puntos para el token:");
        if(points != null && points != ""){
            $.ajax({
                url: ajaxurl,
                method: 'POST',
                data: {
                    action: 'generate_token',
                    points: points
                },
                success: function(response) {
                    if(response.success){
                        alert("Token generado: " + response.data.token + "\nPuntos: " + response.data.points);
                    } else {
                        alert("Error al generar token");
                    }
                }
            });
        }
    });
});
