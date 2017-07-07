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

           <div class="container">
              <h2>Range Sliders <small>Elige el mínimo de reputación para adquirir el nuevo logro!</small></h2>
              <hr/>

              <div class="row">
                <div class="col-xs-6">
                  <div class="range range-warning">
                    <input type="range" name="range" min="1" max="100" value="50" onchange="rangeWarning.value=value">
                    <output id="rangeWarning">50 </output>
                  </div>
                </div>
                
            </div>




    <style type="text/css">


            .range {
                display: table;
                position: relative;
                height: 25px;
                margin-top: 20px;
                background-color: rgb(245, 245, 245);
                border-radius: 4px;
                -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
                box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
                cursor: pointer;
            }

            .range input[type="range"] {
                -webkit-appearance: none !important;
                -moz-appearance: none !important;
                -ms-appearance: none !important;
                -o-appearance: none !important;
                appearance: none !important;

                display: table-cell;
                width: 100%;
                background-color: transparent;
                height: 25px;
                cursor: pointer;
            }
            .range input[type="range"]::-webkit-slider-thumb {
                -webkit-appearance: none !important;
                -moz-appearance: none !important;
                -ms-appearance: none !important;
                -o-appearance: none !important;
                appearance: none !important;

                width: 11px;
                height: 25px;
                color: rgb(255, 255, 255);
                text-align: center;
                white-space: nowrap;
                vertical-align: baseline;
                border-radius: 0px;
                background-color: rgb(153, 153, 153);
            }

            .range input[type="range"]::-moz-slider-thumb {
                -webkit-appearance: none !important;
                -moz-appearance: none !important;
                -ms-appearance: none !important;
                -o-appearance: none !important;
                appearance: none !important;
                
                width: 11px;
                height: 25px;
                color: rgb(255, 255, 255);
                text-align: center;
                white-space: nowrap;
                vertical-align: baseline;
                border-radius: 0px;
                background-color: rgb(153, 153, 153);
            }

            .range output {
                display: table-cell;
                padding: 3px 5px 2px;
                min-width: 40px;
                color: rgb(255, 255, 255);
                background-color: rgb(153, 153, 153);
                text-align: center;
                text-decoration: none;
                border-radius: 4px;
                border-bottom-left-radius: 0;
                border-top-left-radius: 0;
                width: 1%;
                white-space: nowrap;
                vertical-align: middle;

                -webkit-transition: all 0.5s ease;
                -moz-transition: all 0.5s ease;
                -o-transition: all 0.5s ease;
                -ms-transition: all 0.5s ease;
                transition: all 0.5s ease;

                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: -moz-none;
                -o-user-select: none;
                user-select: none;
            }
            .range input[type="range"] {
                outline: none;
            }

            .range.range-warning input[type="range"]::-webkit-slider-thumb {
                background-color: rgb(240, 173, 78);
            }
            .range.range-warning input[type="range"]::-moz-slider-thumb {
                background-color: rgb(240, 173, 78);
            }
            .range.range-warning output {
                background-color: rgb(240, 173, 78);
            }
            .range.range-warning input[type="range"] {
                outline-color: rgb(240, 173, 78);
            }


    </style>

    <script type="text/javascript">
        $('input[name="range"]').on("change mousemove", function() {
        $(this).next().html($(this).val() );
        });
    </script>
