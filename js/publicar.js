function validateFormPublicar() {
	var nombre = document.publicar_form.nombreProd.value;
    if (nombre == null || nombre.length == 0 || /^\s*$/.test(nombre)) {
      alert("El valor ' " + document.publicar_form.nombreProd.value +" '"+" no parece válido para un Nombre"); //antes no andaban pq habia un * al final en vez del + que hay ahora;
      return false;                                                                                   //el * significa 0 ó + elementos (por eso cuando no tomaba nada del campo te lo ponia como bien) y el + significa 1 ó mas elementos (si hay un campo vacio ahora si salta el alerta!!)
    }
    var desc = document.publicar_form.desc.value;
    if (desc == null || desc.length == 0 || /^\s*$/.test(desc)) {
      alert("La descripcion del producto es de caracter obligatorio"); //antes no andaban pq habia un * al final en vez del + que hay ahora;
      return false;                                                                                   //el * significa 0 ó + elementos (por eso cuando no tomaba nada del campo te lo ponia como bien) y el + significa 1 ó mas elementos (si hay un campo vacio ahora si salta el alerta!!)
    }
     if (!/^([0-9])+$/.test(document.publicar_form.precio.value)) {
      alert("No debes olvidar de indicar el precio del producto");
      return false;
    }

    fecha = new Date(document.signUp_form.birthDate.value);
    hoy = new Date();
    res = parseInt((hoy - fecha)/365/24/60/60/1000)
    if(res > 0){
        alert("Debes ingresar una fecha de expiracion posterior a la actual." );
        return false;
    }

	//para checkear foto...
	// Upload == true cuando se subió una foto. Ok = true cuando la extensión del archivo subido es jpg, jpeg, png o gif.

	var filename = document.publicar_form.img.value;
	var Upload = false;
	var Ok = false;
	if (filename.length > 0) {
		var Upload = true;
		var extension = filename.substr(filename.lastIndexOf('.')+1).toLowerCase();
		if (extension == 'jpg' || extension == 'jpeg' || extension == 'png' || extension == 'gif') {
			var Ok = true;
		} 
	}
	if (!Upload){
		alert("Debés ingresar una foto correspondiente al producto.");
		return false;
	}
	if (!Ok){
		alert("La extensión del archvo subido no es aceptada.");
		return false;
	}	
 
 	return true;
}