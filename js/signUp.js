function validateFormSignUp() {
	  //usamos expresiones regulares.... hay que agregar lo del mail y lo de que las contraseñas no estén vacias
	
    if (!/^([A-z])+$/.test(document.signUp_form.name.value)) {
      alert("El valor ' " + document.signUp_form.name.value +" '"+" no parece válido para un Nombre"); //antes no andaban pq habia un * al final en vez del + que hay ahora;
      return false;                                                                                   //el * significa 0 ó + elementos (por eso cuando no tomaba nada del campo te lo ponia como bien) y el + significa 1 ó mas elementos (si hay un campo vacio ahora si salta el alerta!!)
    }
    if (!/^([A-z])+$/.test(document.signUp_form.surname.value)) {
      alert("El valor ' " + document.signUp_form.surname.value +" '"+" no parece válido para un Apellido ");
      return false;
    }
    if (!/^([0-9]{5,20})+$/.test(document.signUp_form.phone.value)) {
      alert("El valor ' " + document.signUp_form.phone.value + " ' no parece válido para un Número de Teléfono");
      return false;
    }
    
    fecha = new Date(document.signUp_form.birthDate.value);
    hoy = new Date();
    ed = parseInt((hoy - fecha)/365/24/60/60/1000)
    if(ed < 18){
        alert("Tenes que ser mayor de edad para registrarte en este sitio. Vos tenes "+ ed + " años." );
        return false;
    }

    var email = document.signUp_form.email.value;
    if (email == null || email.length == 0 || /^\s*$/.test(email)){
        alert("El campo 'Email' no puede estar vacio o contener sólo espacios en blanco");
        return false;
    }
    var x = document.signUp_form.pass1.value;
	  var y = document.signUp_form.pass2.value;
    	
   if (x == null || x.length == 0 || /^\s*$/.test(x) || y == null || y.length == 0 || /^\s*$/.test(y)){    
        alert("Las passwords no pueden estar vacías o contener sólo espacios en blanco");
        return false;
   }else if (x.length > 20) {
    	 alert("Las passwords no pueden tener más de 20 caracteres!");
    	 return false;
    	} 
    else if (x != y) {
       alert("Las passwords no coinciden!");
       return false;
      }  


    return true;
}