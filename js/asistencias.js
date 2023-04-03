		$(document).ready(function() {
			$("#resultados_citas").load("../ajax/carga_citas.php");
			$("#resultados_citas_total").load("../ajax/carga_citas_total.php");
			$("#resultados3").load("../ajax/carga_ofrenda.php");
			load(1);
		});

		function load(page) {
			var range = $("#range").val();
			var cel = $("#cel").val();
			var parametros = {
				"action": "ajax",
				"page": page,
				'range': range,
				'cel': cel
			};
			$("#loader").fadeIn('slow');
			$.ajax({
				url: '../ajax/buscar_asistencias.php',
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

		$("#guardar_ast").submit(function(event) {
			$('#guardar_datos').attr("disabled", true);
			var parametros = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "../ajax/nuevo_ast.php",
				data: parametros,
				beforeSend: function(objeto) {
					$("#resultados_ajax").html('<img src="../../img/ajax-loader.gif"> Cargando...');
				},
				success: function(datos) {
					$("#resultados_ajax").html(datos);
					$('#guardar_datos').attr("disabled", false);
					load(1);
		            //resetea el formulario
		            $("#guardar_ast")[0].reset();
		            $("#nombre").focus();
		            //desaparecer la alerta
		            window.setTimeout(function() {
		            	$(".alert").fadeTo(200, 0).slideUp(200, function() {
		            		$(this).remove();
		            	});
		            }, 2000);
		        }
		    });
			event.preventDefault();
		})
		$("#editar_ast").submit(function(event) {
		    $('#actualizar_datos').attr("disabled", true);
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/editar_asistencia.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $("#resultados_ajax2").html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(datos) {
		            $("#resultados_ajax2").html(datos);
		            $('#actualizar_datos').attr("disabled", false);
		            load(1);
		            //desaparecer la alerta
		            window.setTimeout(function() {
		                $(".alert").fadeTo(200, 0).slideUp(200, function() {
		                    $(this).remove();
		                });
		            }, 2000);
		        }
		    });
		    event.preventDefault();
		})
		function obtener_datos(id) {
			var celula_id = $("#celula_id" + id).val();
			var hermanos = $("#hermanos" + id).val();
			var amigos = $("#amigos" + id).val();
			var ninos = $("#ninos" + id).val();
			var ofrenda = $("#ofrenda" + id).val();
			var conv = $("#conv" + id).val();
			var recon = $("#recon" + id).val();
			var bautismos = $("#bautismos" + id).val();
			var seminarista = $("#seminarista" + id).val();
			var ast_iglesia = $("#ast_iglesia" + id).val();
			var date_added = $("#date_added" + id).val();

			$("#id_cel2").val(celula_id);
			$("#herm2").val(hermanos);
			$("#amigos2").val(amigos);
			$("#ninos2").val(ninos);
			$("#ofrenda2").val(ofrenda);
			$("#conv2").val(conv);
			$("#recon2").val(recon);
			$("#baut2").val(bautismos);
			$("#sem2").val(seminarista);
			$("#ast2").val(ast_iglesia);
			$("#fecha2").val(date_added);
			$("#mod_id").val(id);
		}

		
		