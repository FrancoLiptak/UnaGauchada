function validateFormAddCat() {
	var nombre = document.addCat_form.nombre.value;
    if (nombre == null || nombre.length == 0 || /^\s*$/.test(nombre)){
        alert("El campo 'nombre' no puede estar vacio o contener sólo espacios en blanco");
        return false;
    }
     return true;
}