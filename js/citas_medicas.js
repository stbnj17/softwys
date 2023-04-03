		$(document).ready(function() {
		    load(1);
		});
		$("#guardar_cita").submit(function(event) {
		    $('#guardar_datos').attr("disabled", true); //boton Guardar
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/nueva_cita.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $("#resultados_ajax").html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(datos) {
		            $("#resultados_ajax").html(datos);
		            $('#guardar_datos').attr("disabled", false); //boton Guardar
		            load(1);
		            //resetea el formulario
		            $("#guardar_cita")[0].reset();
		            $("#nombre").focus();
		            //desaparecer la alerta
		            window.setTimeout(function() {
		                $(".alert").fadeTo(500, 0).slideUp(500, function() {
		                    $(this).remove();
		                });
		            }, 5000);
		        }
		    });
		    event.preventDefault();
		})
		$("#editar_cita").submit(function(event) {
		    $('#actualizar_datos').attr("disabled", true); //boton Guardar
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/editar_cita.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $("#resultados_ajax2").html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(datos) {
		            $("#resultados_ajax2").html(datos);
		            $('#actualizar_datos').attr("disabled", false); //boton Guardar
		            load(1);
		            //desaparecer la alerta
		            window.setTimeout(function() {
		                $(".alert").fadeTo(500, 0).slideUp(500, function() {
		                    $(this).remove();
		                });
		            }, 5000);
		        }
		    });
		    event.preventDefault();
		})
		$("#eliminarDatos").submit(function(event) {
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/eliminar_cliente.php",
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
		                $(".alert").fadeTo(500, 0).slideUp(500, function() {
		                    $(this).remove();
		                });
		            }, 5000);
		        }
		    });
		    event.preventDefault();
		});

		function obtener_datos(id) {
		    var nombre_cliente = $("#nombre_cliente" + id).val();
		    var fiscal_cliente = $("#fiscal_cliente" + id).val();
		    var telefono_cliente = $("#telefono_cliente" + id).val();
		    var email_cliente = $("#email_cliente" + id).val();
		    var direccion_cliente = $("#direccion_cliente" + id).val();
		    var status_cliente = $("#status_cliente" + id).val();
		    $("#mod_nombre").val(nombre_cliente);
		    $("#mod_fiscal").val(fiscal_cliente);
		    $("#mod_telefono").val(telefono_cliente);
		    $("#mod_email").val(email_cliente);
		    $("#mod_direccion").val(direccion_cliente);
		    $("#mod_estado").val(status_cliente);
		    $("#mod_id").val(id);
		}