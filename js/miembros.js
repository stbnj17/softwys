		$(document).ready(function() {
			$("#resultados_citas").load("../ajax/carga_citas.php");
			$("#resultados_citas_total").load("../ajax/carga_citas_total.php");
			load(1);
		});

		function load(page) {
			var q = $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url: '../ajax/buscar_miembro.php?action=ajax&page=' + page + '&q=' + q,
				beforeSend: function(objeto) {
					$('#loader').html('<img src="../../img/ajax-loader.gif"> Cargando...');
				},
				success: function(data) {
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					$('[data-toggle="tooltip"]').tooltip({
						html: true
					});
				}
			})
		}
		$("#guardar_paciente").submit(function(event) {
			$('#guardar_datos').attr("disabled", true);
			var parametros = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "../ajax/nuevo_miembro.php",
				data: parametros,
				beforeSend: function(objeto) {
					$("#resultados_ajax").html('<img src="../../img/ajax-loader.gif"> Cargando...');
				},
				success: function(datos) {
					$("#resultados_ajax").html(datos);
					$('#guardar_datos').attr("disabled", false);
					load(1);
		            //resetea el formulario
		            $("#guardar_paciente")[0].reset();
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
		$("#editar_miembro").submit(function(event) {
			$('#actualizar_datos').attr("disabled", true);
			var parametros = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "../ajax/editar_miembro.php",
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
		$('#dataDelete').on('show.bs.modal', function(event) {
		    var button = $(event.relatedTarget) // Botón que activó el modal
		    var id = button.data('id') // Extraer la información de atributos de datos
		    var modal = $(this)
		    modal.find('#id_miembro').val(id)
		})
		$("#eliminarDatos").submit(function(event) {
			var parametros = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "../ajax/eliminar_miembro.php",
				data: parametros,
				beforeSend: function(objeto) {
					$(".datos_ajax_delete").html('<img src="../../img/ajax-loader.gif"> Cargando...');
				},
				success: function(datos) {
					$(".datos_ajax_delete").html(datos);
					$('#dataDelete').modal('hide');
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
		});

		function obtener_datos(id) {
			var nombre_miembro = $("#nombre_miembro" + id).val();
			var apellido_miembro = $("#apellido_miembro" + id).val();
			var direccion_miembro = $("#direccion_miembro" + id).val();
			var ciudad_miembro = $("#ciudad_miembro" + id).val();
			var celular_miembro = $("#celular_miembro" + id).val();
			var telefono_miembro = $("#telefono_miembro" + id).val();
			var encargado_miembro = $("#encargado_miembro" + id).val();
			var fecha_nacimiento = $("#fecha_nacimiento" + id).val();
			var estudio_miembro = $("#estudio_miembro" + id).val();
			var cargo_miembro = $("#cargo_miembro" + id).val();
			var civil_miembro = $("#civil_miembro" + id).val();
			var documento_miembro = $("#documento_miembro" + id).val();
			var email_miembro = $("#email_miembro" + id).val();
			var sexo_miembro = $("#sexo_miembro" + id).val();
			var status_miembro = $("#status_miembro" + id).val();
			var familia_id = $("#familia_id" + id).val();
			$("#mod_nombre").val(nombre_miembro);
			$("#mod_apellido").val(apellido_miembro);
			$("#mod_direccion").val(direccion_miembro);
			$("#mod_ciudad").val(ciudad_miembro);
			$("#mod_celular").val(celular_miembro);
			$("#mod_telefono").val(telefono_miembro);
			$("#mod_encargado").val(encargado_miembro);
			$("#mod_nacimiento").val(fecha_nacimiento);
			$("#mod_estudio").val(estudio_miembro);
			$("#mod_cargo").val(cargo_miembro);
			$("#mod_civil").val(civil_miembro);
			$("#mod_documento").val(documento_miembro);
			$("#mod_email").val(email_miembro);
			$("#mod_sexo").val(sexo_miembro);
			$("#mod_estado").val(status_miembro);
			$("#mod_family").val(familia_id);
			$("#mod_id").val(id);
		}