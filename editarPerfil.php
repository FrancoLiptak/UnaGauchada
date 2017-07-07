<html>
    <head>
        <?php
        include_once "header.php";
        include_once 'validate.php';
        include_once 'gauchadasFx.php';
        include_once 'alert.php';
        include("footer.html");
        ?>
    </head>
    <body>
        <div class="row">
            <div class="container-fluid  col-md-4 col-md-offset-4 ph">
                <div class="page-header">
                    <h3 style="text-align:center;">Logros</h3>
                </div>
            </div>
        </div>
        <br>


        <script type="text/javascript">
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
        </script>

        <style type="text/css">
            .btn-file {
                position: relative;
                overflow: hidden;
            }
            .btn-file input[type=file] {
                position: absolute;
                top: 0;
                right: 0;
                min-width: 100%;
                min-height: 100%;
                font-size: 100px;
                text-align: right;
                filter: alpha(opacity=0);
                opacity: 0;
                outline: none;
                background: white;
                cursor: inherit;
                display: block;
            }

            #img-upload{
                width: 100%;
            }
                    </style>

<div class="row centered">
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <div class="form-group">
                    <label>Imagen de perfil</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                Editar <input type="file" id="imgInp">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <img id='img-upload' src="imgs/at1.jpg"/>
                </div>
            </div>
        </div>
</div>