		$(document).ready(function() {
		    $("#resultados_citas").load("../ajax/carga_citas.php");
		    $("#resultados_citas_total").load("../ajax/carga_citas_total.php");
		    $("#resultados3").load("../ajax/carga_ofrenda.php");
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
		        url: '../ajax/buscar_ingreso.php',
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
		$("#guardar_ingreso").submit(function(event) {
		    $('#guardar_datos').attr("disabled", true);
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/nuevo_ingreso.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $("#resultados_ajax").html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(datos) {
		            $("#resultados_ajax").html(datos);
		            $('#guardar_datos').attr("disabled", false);
		            load(1);
		            //resetea el formulario
		            $("#guardar_ingreso")[0].reset();
		            $("#resultados3").load("../ajax/carga_ofrenda.php");
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
		$("#editar_ingreso").submit(function(event) {
		    $('#actualizar_datos').attr("disabled", true);
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/editar_ingreso.php",
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
		    modal.find('#id_ingreso').val(id)
		})
		$("#eliminarDatos").submit(function(event) {
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/eliminar_ingreso.php",
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
		    var cat_ingreso = $("#cat_ingreso" + id).val();
		    var ref = $("#ref" + id).val();
		    var modo_pago = $("#modo_pago" + id).val();
		    var monto = $("#monto" + id).val();
		    var obs = $("#obs" + id).val();
		    var date_added = $("#date_added" + id).val();
		    var nombre = $("#nombre" + id).val();
		    $("#mod_tipo").val(cat_ingreso);
		    $("#mod_ref").val(ref);
		    $("#mod_modo").val(modo_pago);
		    $("#mod_monto").val(monto);
		    $("#mod_obs").val(obs);
		    $("#mod_fech").val(date_added);
		    $("#mod_nombre").val(nombre);
		    $("#mod_id").val(id);
		}