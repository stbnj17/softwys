<label for="ref" class="control-label">Miembro:</label>
<input type="text" class="form-control" id="ref" name="ref"  autocomplete="off" placeholder="Buscar Miembro" required>
<input id="id_miembro" name="id_miembro" type='hidden'>

		<script>
		$(function() {
			$("#ref").autocomplete({
				source: "../ajax/autocomplete/miembros.php",
				minLength: 2,
				appendTo: "#nuevoIngreso",
				select: function(event, ui) {
					event.preventDefault();
					$('#id_miembro').val(ui.item.id_miembro);
					$('#ref').val(ui.item.nombre_miembro);
					$.Notification.notify('success','bottom center','EXITO!', 'MIEMBRO AGREGADO CORRECTAMENTE')
				}

			});


		});

		$("#ref" ).on( "keydown", function( event ) {
			if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
			{
				$("#id_miembro" ).val("");
			}
			if (event.keyCode==$.ui.keyCode.DELETE){
				$("#ref" ).val("");
				$("#id_miembro" ).val("");
			}
		});
	</script>
