		$(document).ready(function() {
		    $("#resultados_citas").load("../ajax/carga_citas.php");
		    $("#resultados_citas_total").load("../ajax/carga_citas_total.php");
		    $("#resultados3").load("../ajax/carga_ofrenda.php");
		    load(1);
		});

		function load(page) {
		    var range = $("#range").val();
		    var tipo = $("#tipo").val();
		    var tipoo = $("#tipoo").val();
		    var parametros = {
		        "action": "ajax",
		        "page": page,
		        'range': range,
		        'tipo': tipo,
		        'tipoo': tipoo
		    };
		    $("#loader").fadeIn('slow');
		    $.ajax({
		        url: '../ajax/rep_ingreso.php',
		        data: parametros,
		        beforeSend: function(objeto) {
		            $("#loader").html("<img src='../../img/ajax-loader.gif'>");
		        },
		        success: function(data) {
		            $(".outer_div").html(data).fadeIn('slow');
		            $("#loader").html("");
		        }
		    })
		}

	
		
		