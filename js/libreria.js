$(document).ready(function () {
  $("#load_autor").load("../ajax/carga_autor.php");
  $("#load_cat").load("../ajax/carga_cat.php");
  $("#load_edit").load("../ajax/carga_edit.php");
  load(1);
});

function load(page) {
  var q = $("#q").val();
  var autor = $("#autor").val();
  $("#loader").fadeIn("slow");
  $.ajax({
    url:
      "../ajax/buscar_libro.php?action=ajax&page=" +
      page +
      "&q=" +
      q +
      "&autor=" +
      autor,
    beforeSend: function (objeto) {
      $("#loader").html('<img src="../../img/ajax-loader.gif"> Cargando...');
    },
    success: function (data) {
      $(".outer_div").html(data).fadeIn("slow");
      $("#loader").html("");
      $('[data-toggle="tooltip"]').tooltip({
        html: true,
      });
    },
  });
}
$("#guardar_libro").submit(function (event) {
  $("#guardar_datos").attr("disabled", true);
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../ajax/nuevo_libro.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#resultados_ajax").html(
        '<img src="../../img/ajax-loader.gif"> Cargando...'
      );
    },
    success: function (datos) {
      $("#resultados_ajax").html(datos);
      $("#guardar_datos").attr("disabled", false);
      load(1);
      //resetea el formulario
      $("#guardar_libro")[0].reset();
      $("#titulo").focus();
      //desaparecer la alerta
      window.setTimeout(function () {
        $(".alert")
          .fadeTo(200, 0)
          .slideUp(200, function () {
            $(this).remove();
          });
      }, 2000);
    },
  });
  event.preventDefault();
});
$("#guardar_autor").submit(function (event) {
  $("#guardar_autor").attr("disabled", true);
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../ajax/nuevo_autor.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#resultados_autor").html(
        '<img src="../../img/ajax-loader.gif"> Cargando...'
      );
    },
    success: function (datos) {
      $("#resultados_autor").html(datos);
      $("#guardar_autor").attr("disabled", false);
      $("#nuevoAutor").modal("hide");
      $("#load_autor").load("../ajax/carga_autor.php");
      //resetea el formulario
      $("#guardar_autor")[0].reset();
      $("#titulo").focus();
      //desaparecer la alerta
      window.setTimeout(function () {
        $(".alert")
          .fadeTo(200, 0)
          .slideUp(200, function () {
            $(this).remove();
          });
      }, 2000);
    },
  });
  event.preventDefault();
});
$("#guardar_cat").submit(function (event) {
  $("#guardar_cat").attr("disabled", true);
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../ajax/nuevo_cat.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#resultados_cat").html(
        '<img src="../../img/ajax-loader.gif"> Cargando...'
      );
    },
    success: function (datos) {
      $("#resultados_cat").html(datos);
      $("#guardar_cat").attr("disabled", false);
      $("#nuevaCat").modal("hide");
      $("#load_cat").load("../ajax/carga_cat.php");
      //resetea el formulario
      $("#guardar_cat")[0].reset();
      $("#titulo").focus();
      //desaparecer la alerta
      window.setTimeout(function () {
        $(".alert")
          .fadeTo(200, 0)
          .slideUp(200, function () {
            $(this).remove();
          });
      }, 2000);
    },
  });
  event.preventDefault();
});
$("#guardar_editorial").submit(function (event) {
  $("#guardar_editorial").attr("disabled", true);
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../ajax/nuevo_edit.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#resultados_edit").html(
        '<img src="../../img/ajax-loader.gif"> Cargando...'
      );
    },
    success: function (datos) {
      $("#resultados_edit").html(datos);
      $("#guardar_editorial").attr("disabled", false);
      $("#nuevaEditorial").modal("hide");
      $("#load_edit").load("../ajax/carga_edit.php");
      //resetea el formulario
      $("#guardar_editorial")[0].reset();
      $("#titulo").focus();
      //desaparecer la alerta
      window.setTimeout(function () {
        $(".alert")
          .fadeTo(200, 0)
          .slideUp(200, function () {
            $(this).remove();
          });
      }, 2000);
    },
  });
  event.preventDefault();
});
$("#editar_libro").submit(function (event) {
  $("#actualizar_datos").attr("disabled", true);
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../ajax/editar_libro.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#resultados_ajax2").html(
        '<img src="../../img/ajax-loader.gif"> Cargando...'
      );
    },
    success: function (datos) {
      $("#resultados_ajax2").html(datos);
      $("#actualizar_datos").attr("disabled", false);
      load(1);
      //desaparecer la alerta
      window.setTimeout(function () {
        $(".alert")
          .fadeTo(200, 0)
          .slideUp(200, function () {
            $(this).remove();
          });
      }, 2000);
    },
  });
  event.preventDefault();
});
$("#dataDelete").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget); // Botón que activó el modal
  var id = button.data("id"); // Extraer la información de atributos de datos
  var modal = $(this);
  modal.find("#id_libro").val(id);
});
$("#eliminarDatos").submit(function (event) {
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../ajax/eliminar_libro.php",
    data: parametros,
    beforeSend: function (objeto) {
      $(".datos_ajax_delete").html(
        '<img src="../../img/ajax-loader.gif"> Cargando...'
      );
    },
    success: function (datos) {
      $(".datos_ajax_delete").html(datos);
      $("#dataDelete").modal("hide");
      load(1);
      //desaparecer la alerta
      window.setTimeout(function () {
        $(".alert")
          .fadeTo(200, 0)
          .slideUp(200, function () {
            $(this).remove();
          });
      }, 2000);
    },
  });
  event.preventDefault();
});

function obtener_datos(id) {
  var titulo = $("#titulo" + id).val();
  var fecha_lanzamiento = $("#fecha_lanzamiento" + id).val();
  var autor_id = $("#autor_id" + id).val();
  var cat_id = $("#cat_id" + id).val();
  var editorial_id = $("#editorial_id" + id).val();
  var idioma = $("#idioma" + id).val();
  var paginas = $("#paginas" + id).val();
  var descripcion = $("#descripcion" + id).val();
  var estado = $("#estad" + id).val();
  $("#mod_titulo").val(titulo);
  $("#mod_fecha").val(fecha_lanzamiento);
  $("#mod_autor").val(autor_id);
  $("#mod_cat").val(cat_id);
  $("#mod_editorial").val(editorial_id);
  $("#mod_idioma").val(idioma);
  $("#mod_paginas").val(paginas);
  $("#mod_descripcion").val(descripcion);
  $("#mod_estado").val(estado);
  $("#mod_id").val(id);
}
