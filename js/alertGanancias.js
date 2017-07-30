function validarFechas(){

    fechaMinima = document.getElementById("fechaMinima").value;
    fechaMaxima = document.getElementById("fechaMaxima").value;
    
    if (fechaMaxima < fechaMinima){
        alert("La fecha ingresada máxima no puede ser mayor a la fecha ingresada mínima.");
        return false;
    }

    return true;

}