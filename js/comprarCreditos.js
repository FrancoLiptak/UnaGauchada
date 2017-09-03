function validateFormComprar(){
	if (! validateCredits()){
		alert("La cantidad de creditos a comprar debe ser un número sin coma, y mayor igual a 0.");
		return false;
	}
	if (! validateNro()){
		alert("La cantidad de digitos del nro de tarjeta no es valida. Notar este debe tener entre 13 y 16 digitos.");
		return false;
	}
	if (! validatePass()){
		alert("La cantidad de digitos del nro de seguridad no es valida. Notar este debe tener 3 digitos.");
		return false;
	}

	if (! validateDate()){
		alert("La tarjeta esta vencida.");
		return false;
	}

	return true;
}

function validateCredits(){
	var patron =  /^\d*$/;
	if (patron.test(document.comprar_form.credits.value)){
		return document.comprar_form.credits.value >= 0;
	}
	return false;
}

function validateNro(){
	return (document.comprar_form.nro.value.length >= 13) && (document.comprar_form.nro.value.length <= 16);
}

function validatePass(){
	return (document.comprar_form.pass.value.length == 3);
}

function validateDate(){
	fecha = new Date(document.comprar_form.endDateCredCard.value);
    hoy = new Date();
    res = parseInt((fecha - hoy)/365/24/60/60/1000)

	return (res >= 0);
}