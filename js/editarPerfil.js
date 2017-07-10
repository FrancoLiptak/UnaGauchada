function showConfirmPassDiv(){
    "Muestra el div para ingresar la contraseña actual antes de realizar un cambio sobre la misma. Esconde el div que te muestra la contraseña con asteriscos."
    updatePassDiv.style.display = 'none';
    oldPassConfirmDiv.style.display = 'block';

}
function validatePass(){
    "Realiza la validacion de la contraseña actual. Si es correcta, te lleva al siguiente paso; sino, muestra un cartel de 'validacion icorrecta'."
    if (realPass == document.getElementById("insertedPass").value) {
        oldPassConfirmDiv.style.display = 'none';
        showNewPassDiv();
    } else { 
        showWrongValidationDiv()
    }

}
function showNewPassDiv(){
    "Muestra el div para ingresar la nueva contraseña."            
    newPassDiv.style.display = 'block';

}
function showWrongValidationDiv(){
    "Muestra el cartel de error al validar en el lugar que estaba el de info de 'ingresa la pass actual'."
    infoRealPassDiv.style.display = 'none';       
    wrongValidationDiv.style.display = 'block';

}
function cancelPassUpdating(toBeHidden){
    "Cancela el cambio de contraseña por ende te vuelve a mostrar el div del principio, con la contraseña hasheada. Como estas en el paso 1 o 2 al llamar a esta funcion, mandas por parametro en cual estas para que ese div se esconda."    
    updatePassDiv.style.display = 'block';
    toBeHidden.style.display = 'none';
    wrongValidationDiv.style.display = 'none';

}


$(document).ready( function() {
    "Funcion obtenida de Internet para el input de la img que previsualiza la foto elegida."
    $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
    
    });
    
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });     
});