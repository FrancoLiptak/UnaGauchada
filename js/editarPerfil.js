function showConfirmPassDiv(){
                        
    updatePass.style.display = 'none';
    oldPassConfirm.style.display = 'block';

}
function validatePass(){
    if (realPass == document.getElementById("insertedPass").value) {
        oldPassConfirm.style.display = 'none';
        showNewPassDiv();
    } else { 
        showWrongValidationDiv()
    }

}
function showNewPassDiv(){
                        
    newPass.style.display = 'block';

}
function showWrongValidationDiv(){
    infoRealPassDiv.style.display = 'none';       
    wrongValidation.style.display = 'block';

}
function showRealPassDiv(toBeHidden){
                        
    updatePass.style.display = 'block';
    toBeHidden.style.display = 'none';
    wrongValidation.style.display = 'none';

}

$(document).ready( function() {
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

function validateFormEditar(){
    if (validatePass()) {
        return true;
    }
    else{
        return false;
    }
}