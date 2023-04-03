		$(document).ready(function() {
		    $("#resultados_citas").load("../ajax/carga_citas.php");
		    $("#resultados_citas_total").load("../ajax/carga_citas_total.php");
		    load(1);
		});

		function load(page) {
		    var range = $("#range").val();
		    var tipoo = $("#tipoo").val();
		    var parametros = {
		        "action": "ajax",
		        "page": page,
		        'range': range,
		        'tipoo': tipoo
		    };
		    $("#loader").fadeIn('slow');
		    $.ajax({
		        url: '../ajax/buscar_gasto.php',
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
		$("#guardar_gasto").submit(function(event) {
		    $('#guardar_datos').attr("disabled", true);
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/nuevo_gasto.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $("#resultados_ajax").html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(datos) {
		            $("#resultados_ajax").html(datos);
		            $('#guardar_datos').attr("disabled", false);
		            load(1);
		            //resetea el formulario
		            $("#guardar_gasto")[0].reset();
		            $("#referencia").focus();
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
		$("#editar_gasto").submit(function(event) {
		    $('#actualizar_datos').attr("disabled", true);
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/editar_gastos.php",
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
		    modal.find('#id_egreso').val(id)
		})
		$("#eliminarDatos").submit(function(event) {
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/eliminar_gasto.php",
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
		    var referencia_egreso = $("#referencia_egreso" + id).val();
		    var date_added = $("#date_added" + id).val();
		    var descripcion_egreso = $("#descripcion_egreso" + id).val();
		    var monto = $("#monto" + id).val();
		    var tipo = $("#tipo" + id).val();
		    $("#mod_referencia").val(referencia_egreso);
		    $("#mod_fech").val(date_added);
		    $("#mod_descripcion").val(descripcion_egreso);
		    $("#mod_monto").val(monto);
		    $("#mod_tipo").val(tipo);
		    $("#mod_id").val(id);
		}