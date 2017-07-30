function validarFechas(){
    fechaMinima = date(document.getElementById("fechaMinima").value);
    fechaMaxima = date(document.getElementById("fechaMaxima").value);

    if (fechaMaxima < fechaMinima){
        document.getElementById("errorFechas").value = "La fecha ingresada máxima no puede ser mayor a la fecha ingresada mínima."
    }

}