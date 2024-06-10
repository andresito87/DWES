$(".verPWD").click(function () {
    if ($(".verPWD i").hasClass("bi-eye-fill")) {
        $(".verPWD i").removeClass("bi-eye-fill");
        $(".verPWD i").addClass("bi-eye-slash-fill");
        $("#pwd").attr("type", "text");
    }
    else {
        $(".verPWD i").removeClass("bi-eye-slash-fill");
        $(".verPWD i").addClass("bi-eye-fill");
        $("#pwd").attr("type", "password");
    }
});
$("#formAcceso").submit(function (event) {
    event.preventDefault();
    datos = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: 'controlacceso.php',
        data: datos,
        success: function (data) {
            if (data == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Acceso denegado',
                    text: 'Login o Password incorrectas'
                });
            }
            else {
                location.href = "adminindex.php";
            }

        }
    });
});

$("#load").click(function() {
    
    if ($("#imagen").val() != "") {
        var file = $("#imagen")[0].files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            $("#imgFoto").attr("src", e.target.result);
            $("#imgFoto").addClass("fotos");
        };
        reader.readAsDataURL(file);
    }
});
function toggleReserva(show) {
    document.getElementById('reservaDetails').style.display = show ? 'block' : 'none';
    document.getElementById('fechaReserva').required = show;
    document.getElementById('importeReserva').required = show;
    };
$().ready(function(){
        $('#situacion').change(function(){
            if($(this).val() == 'ALQUILER'){
                $('#precalq').show();
                $('#precvent').hide();
            } else if($(this).val() == 'VENTA'){
                $('#precvent').show();
                $('#precalq').hide();
            }
        });
    });
    $("#formagrcasa").submit(function (event) {
        event.preventDefault();
        var reservado;
        if ($("#reservadaNO").is(":checked")) {
            reservado= "N";
        }else{
            reservado= "S";
        }
  
       
        var file = new FormData();
        file.append("calle", $("#calle").val());
        file.append("ciudad", $("#ciudad").val());
        file.append("cp", $("#cp").val());
        file.append("IDProvincia", $("#provincia").val());
        file.append("MetrosCuadrados", $("#MetrosCuadrados").val());
        file.append("NumHabitaciones", $("#habitaciones").val());
        file.append("NumServicios", $("#servicios").val());
        file.append("PeriodoConstruccion", $("#fechaconst").val());
        file.append("Foto", $('#imagen')[0].files[0]);
        file.append("LinkMaps", $("#link").val());
        file.append("SituacionInmueble", $("#situacion").val());
        file.append("precioalquiler", $("#precioalquiler").val());
        file.append("precioventa", $("#precioventa").val());
        file.append("NRefCat", $("#refcatastral").val());
        file.append("reservado", reservado);
        file.append("fechareserva", $("#fechareserva").val());
        file.append("importereserva", $("#importereserva").val());

        $.ajax({
            type: 'POST',
            url: 'agregarinmueble.php',
            cache: false,
            processData: false,
            contentType: false,
            data: file,
            success: function(data){
                alert(data);
               
            }
        });
    });
    $("#tablainmuebles").on("click",".btnEliminar",function(){
        let id = $(this).parents("tr").find("td").eq(0).text();
        let calle = $(this).parents("tr").find("td").eq(1).text();
        
        Swal.fire({
            icon: 'question',
            title: 'CONFIRMAR',
            html: 'Confirmar la eliminación del inmueble de la calle <b>' + calle + "</b>",
            showCancelButton: true,
            confirmButtonText: "SI BORRAR",
            cancelButtonText: "NO CANCELAR"
        }).then((response)=>{
            if (response.isConfirmed) {
                //Procede a eliminar//
                $.ajax({
                    type: 'POST',
                    url:   'eliminarInmueble.php',
                    data: {'identificador': id},
                    success: function(data){
                        location.href = "adminindex.php";
                    }
                });
            }
        })
    });
    $("#listProvincia").change(function(){
        let provincia = $(this).val();  
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: 'datosProvincias.php',
            data: {'provinciaBuscada':provincia},
            success: function(data){
                let html = "";
                for (let index = 0; index < data.length; index++) {
                    html+="<tr class='text-center align-middle'><td>" + data[index].id + "</td><td>" + data[index].calle + "</td><td class='w-25'><img src='" + data[index].foto + "' alt='" + data[index].calle + "' class='img-fluid'></td><td>"+data[index].situacion+"</td><td>"+data[index].precioalquiler+"</td><td>"+data[index].precioventa+"</td></tr>";
                
                }
                $("#tablamostrar tbody").html(html);
            }
        });
    });
    $("#EditarInmueble").submit(function(event){
        event.preventDefault();
      
        var reservado;
        if ($("#reservadaNO").is(":checked")) {
            reservado= "N";
        }else{
            reservado= "S";
        }
  
        var file = new FormData();
        file.append("IdInmueble", $("#idinmueble").val());
        file.append("calle", $("#calle").val());
        file.append("ciudad", $("#ciudad").val());
        file.append("cp", $("#cp").val());
        file.append("IDProvincia", $("#provincia").val());
        file.append("MetrosCuadrados", $("#MetrosCuadrados").val());
        file.append("NumHabitaciones", $("#habitaciones").val());
        file.append("NumServicios", $("#servicios").val());
        file.append("PeriodoConstruccion", $("#fechaconst").val());
        file.append("Foto", $('#imagen')[0].files[0]);
        file.append("LinkMaps", $("#link").val());
        file.append("SituacionInmueble", $("#situacion").val());
        file.append("precioalquiler", $("#precioalquiler").val());
        file.append("precioventa", $("#precioventa").val());
        file.append("NRefCat", $("#refcatastral").val());
        file.append("reservado", reservado);
        file.append("fechareserva", $("#fechareserva").val());
        file.append("importereserva", $("#importereserva").val());
        $.ajax({
            type: 'POST',
            url: 'actualizaInmueble.php',
            cache: false,
            processData: false,
            contentType: false,
            data: file,
            success: function(data){
                alert(data);
                if (data == 0) {
                    location.href = "adminindex.php"
                }
            }
        });
    });