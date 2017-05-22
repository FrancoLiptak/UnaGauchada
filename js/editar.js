function validateFormEditar() {
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
     if (!/^([0-9])+$/.test(document.editar_form.precio.value)) {
      alert("No debes olvidar de indicar el precio del producto");
      return false;
    }

	//no podemos checkear la foto ya que toma como que el input file esta vacío y no le podemos poner a ese input
	//como  value '$fila[contenidoimagen]' ...

   /* para controlar la fecha.... parece correcto pero no anda!! 

   // var x=new Date();
	var fecha = document.editar_form.caducidad.value.split("/",3);
   // x.setFullYear(fecha[2],fecha[1],fecha[0]);
    var today = new Date();
    var today_aux = today.split("/",3);
    //cheeckeo años .............. (es lo unico que se puede llegar a ingresar mal)
    if (fecha[2] >= today_aux[2])
	    return true;
	else{
		alert("La fecha de caducidad debe ser mayor a la fecha actual");
		return false;
	}
	
	*/






	return true;
}