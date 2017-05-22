function  validateFormEditarPerfil(){
	if (document.editarPerfil_form.name.value  == null || document.editarPerfil_form.name.value.length == 0 || /^\s+$/.test(document.editarPerfil_form.name.value)) {
      alert("El valor ' " + document.editarPerfil_form.name.value +" '"+" no parece válido para un Nombre"); //antes no andaban pq habia un * al final en vez del + que hay ahora;
      return false;                                                                                   //el * significa 0 ó + elementos (por eso cuando no tomaba nada del campo te lo ponia como bien) y el + significa 1 ó mas elementos (si hay un campo vacio ahora si salta el alerta!!)
    }
    if (document.editarPerfil_form.name.value  == null || document.editarPerfil_form.surname.value.length == 0 || /^\s+$/.test(document.editarPerfil_form.surname.value)) {
      alert("El valor ' " + document.editarPerfil_form.surname.value +" '"+" no parece válido para un Apellido ");
      return false;
    }
    if (!/^([0-9]{7,11})+$/.test(document.editarPerfil_form.phone.value)) {
      alert("El valor ' " + document.editarPerfil_form.phone.value + " ' no parece válido para un Número de Teléfono");
      return false;
    }
    var email = document.editarPerfil_form.email.value;
    if (email == null || email.length == 0 || /^\s*$/.test(email)){
        alert("El campo 'Email' no puede estar vacio o contener sólo espacios en blanco");
        return false;
    }
    var x = document.editarPerfil_form.pass1.value;
    var y = document.editarPerfil_form.pass2.value;

    if (  (x == null) && (y != null)  ){    
        alert("Falta ingresar una password!");
        return false;
    }
    else if(  (x != null) && (y == null)  ){    
        alert("Falta ingresar una password!");
        return false;
    }
    else if (  (x != null) && (y != null) && (x != y)   ){
    	 alert("Las passwords no coinciden!");
    	 return false;
    	}  


    return true;
}