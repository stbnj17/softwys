		$(document).ready(function() {
		    $("#resultados_citas").load("../ajax/carga_citas.php");
		    $("#resultados_citas_total").load("../ajax/carga_citas_total.php");
		    load(1);
		});

		function load(page) {
		    var q = $("#q").val();
			var range = $("#range").val();
		    $("#loader").fadeIn('slow');
		    $.ajax({
		        url: '../ajax/bitacora_devocion.php?action=ajax&page=' + page + '&q=' + q + '&range=' + range ,
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
		$("#guardar_dev").submit(function(event) {
		    $('#guardar_datos').attr("disabled", true);
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/nuevo_dev.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $("#resultados_ajax").html('<img src="../../img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(datos) {
		            $("#resultados_ajax").html(datos);
		            $('#guardar_datos').attr("disabled", false);
		            load(1);
		            //resetea el formulario
		            $("#guardar_dev")[0].reset();
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
		$("#editar_dev").submit(function(event) {
		    $('#actualizar_datos').attr("disabled", true);
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/editar_dev.php",
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
		    modal.find('#id_dev').val(id)
		})
		$("#eliminarDatos").submit(function(event) {
		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/eliminar_dev.php",
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
		    var evento = $("#evento" + id).val();
		    var fecha = $("#fecha" + id).val();
		    var varones = $("#varones" + id).val();
		    var hembras = $("#hembras" + id).val();
		    var ninos = $("#ninos" + id).val();
		    var ofrenda = $("#ofrenda" + id).val();
		    var conv = $("#conv" + id).val();
		    var rec = $("#rec" + id).val();
		    var btm = $("#btm" + id).val();
		   
		    $("#evento2").val(evento);
		    $("#fecha2").val(fecha);
		    $("#varones2").val(varones);
		    $("#hembras2").val(hembras);
		    $("#ninos2").val(ninos);
		    $("#ofrenda2").val(ofrenda);
		    $("#conv2").val(conv);
		    $("#rec2").val(rec);
		    $("#btm2").val(btm);
		    $("#mod_id").val(id);
		}