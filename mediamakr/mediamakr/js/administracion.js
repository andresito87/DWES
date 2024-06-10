$("#acceso").submit(function (event) {
  event.preventDefault();
  let datos = $(this).serialize();

  $.ajax({
    type: "POST",
    url: "accessUser.php",
    data: datos,
    success: function (data) {
      if (data == 1) {
        location.href = "adminIndex.php";
      } else {
        Swal.fire({
          icon: "error",
          title: "NO AUTORIZADO",
          text: "Datos de acceso ioncorrectos",
        });
      }
    },
  });
});
$("#AddFamily").submit(function (event) {
  event.preventDefault();
  let datos = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "agregarFamilia.php",
    data: datos,
    success: function (data) {
      if (data != "null") {
        let html = "";
        html +=
          "<tr><td class='col-1 text-end'>" +
          data +
          "</td><td>" +
          $("#familia").val() +
          "</td><td><a href='editarFamilia.php?id=" +
          data +
          "' class='btn btn-primary'>EDITAR</a></td><td><a href='eliminarFamilia.php?id=" +
          data +
          "' class='btn btn-danger'>ELIMINAR</a></td></tr>";
        $("#tablaFamilias tbody").append(html);
        $("#familia").val("");
        location.href = "addFamily.php";
      }
    },
  });
});
$("#oferta").click(function () {
  if ($(this).is(":checked")) {
    $("#precioOferta").attr("disabled", false);
  } else {
    $("#precioOferta").val("0");
    $("#precioOferta").attr("disabled", "disabled");
  }
});
$("#AddArticulo").submit(function (event) {
  event.preventDefault();
  var oferta = "N";
  var activo = "S";
  if ($("#oferta").is(":checked")) {
    oferta = "S";
  }
  if ($("#activoN").is(":checked")) {
    activo = "N";
  }
  var file = new FormData();
  file.append("nombreArticulo", $("#nombreArticulo").val());
  file.append("familiaArticulo", $("#familiaArticulo").val());
  file.append("precioArticulo", $("#precioArticulo").val());
  file.append("oferta", oferta);
  file.append("precioOferta", $("#precioOferta").val());
  file.append("imagen", $("#imagen")[0].files[0]);
  file.append("activo", activo);
  file.append("observaciones", $("#observaciones").val());
  $.ajax({
    type: "POST",
    url: "agregarArticulo.php",
    cache: false,
    processData: false,
    contentType: false,
    data: file,
    success: function (data) {
      alert(data);
    },
  });
});
$("#listFamily").change(function () {
  let familia = $(this).val();

  $.ajax({
    type: "POST",
    dataType: "JSON",
    url: "datosFamilias.php",
    data: { familiaBuscada: familia },
    success: function (data) {
      console.log(data);
      let html = "";
      for (let index = 0; index < data.length; index++) {
        html +=
          "<tr class='text-center align-middle'><td class='w-25'><img src='" +
          data[index].foto +
          "' alt='" +
          data[index].nombre +
          "' class='img-fluid'></td><td>" +
          data[index].id +
          "</td><td>" +
          data[index].nombre +
          "</td>";
        if (data[index].oferta == "S") {
          html +=
            "<td><span class='text-decoration-line-through'>" +
            data[index].precio +
            "</span><br><span class='text-danger'>" +
            data[index].precioOferta +
            "</td><td><a href='editarArticulo.php?id=" +
            data[index].id +
            "' class='btn btn-primary'>EDITAR</a></td></td><td><button type='button' class='btn btn-danger btnEliminar'>ELIMINAR</button></td></tr>";
        } else {
          html +=
            "<td>" +
            data[index].precio +
            "<td><a href='editarArticulo.php?id=" +
            data[index].id +
            "' class='btn btn-primary'>EDITAR</a></td></td><td><button type='button' class='btn btn-danger btnEliminar'>ELIMINAR</button></td></tr>";
        }
      }
      $("#listaTabla tbody").html(html);
    },
  });
});
$("#listaTabla").on("click", ".btnEliminar", function () {
  let id = $(this).parents("tr").find("td").eq(1).text();
  let nombre = $(this).parents("tr").find("td").eq(2).text();
  Swal.fire({
    icon: "question",
    title: "CONFIRMAR",
    html: "Confirmar la eliminación del artículo <b>" + nombre + "</b>",
    showCancelButton: true,
    confirmButtonText: "SI BORRAR",
    cancelButtonText: "NO CANCELAR",
  }).then((response) => {
    if (response.isConfirmed) {
      //Procede a eliminar//
      $.ajax({
        type: "POST",
        url: "eliminarArticulo.php",
        data: { identificador: id },
        success: function (data) {
          location.href = "listaArticulosFamilia.php";
        },
      });
    }
  });
});
$("#EditarArticulo").submit(function (event) {
  event.preventDefault();
  var oferta = "N";
  var activo = "S";
  if ($("#oferta").is(":checked")) {
    oferta = "S";
  }
  if ($("#activoN").is(":checked")) {
    activo = "N";
  }
  var file = new FormData();
  file.append("id", $("#Referencia").val());
  file.append("nombreArticulo", $("#nombreArticulo").val());
  file.append("familiaArticulo", $("#familiaArticulo").val());
  file.append("precioArticulo", $("#precioArticulo").val());
  file.append("oferta", oferta);
  file.append("precioOferta", $("#precioOferta").val());
  file.append("imagen", $("#imagen")[0].files[0]);
  file.append("activo", activo);
  file.append("observaciones", $("#observaciones").val());
  $.ajax({
    type: "POST",
    url: "actualizaArticulo.php",
    cache: false,
    processData: false,
    contentType: false,
    data: file,
    success: function (data) {
      if (data == 0) {
        location.href = "listaArticulosFamilia.php";
      }
    },
  });
});
