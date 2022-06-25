<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() . 'assets/img/favicon.png' ?>">
        <title>Sistema del MFC Paraguay</title>
        <link href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.css'; ?>" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url() . 'assets/jquery/css/jquery-ui-1.10.0.custom.css'; ?>" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url() . 'assets/pnotify/pnotify.custom.min.css'; ?>" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url() . 'assets/css/main.css'; ?>" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/datepicker/js/jquery.datetimepicker.css' ?>" />

        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/bootstrap/toggle/css/bootstrap-toggle.min.css' ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/bootstrap-submenu/css/bootstrap-submenu.css' ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/bootstrap-timepicker/css/bootstrap-timepicker.min.css' ?>">

        <script type="text/javascript" src="<?php echo base_url() . 'assets/jquery/jquery-3.3.1.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/jquery/jquery-ui-1.9.2.custom.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/validation/jquery.validate.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/validation/additional-methods.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/validation/messages_es.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/pnotify/pnotify.custom.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/bootstrap/toggle/js/bootstrap-toggle.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/datepicker/js/jquery.datetimepicker.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/bootstrap-submenu/js/bootstrap-submenu.js' ?>"></script>
        <!--data table-->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/data_tables/css/dataTables.bootstrap.css" media="screen" />
        <script type="text/javascript" src="<?= base_url() ?>assets/data_tables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/data_tables/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
        <!--fin data table-->

        <script type="text/javascript" src="<?= base_url() ?>assets/chosen/chosen.jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/chosen/chosen.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/fileinput/css/fileinput.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/bootstrap/css/bootstrapValidator.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/submenu.css">
        <script type="text/javascript" src="<?= base_url() ?>assets/js/principal/principal.js"></script>
    </head>    
    <body>

        <div class="container-fluid" id="contenedor_general">

            <div class="navbar-fixed-top" id="contenedor_menu">
                <?php
                /*
                 *  header de la pagina principal del sistema
                 */
                echo Modules::run('frontend/front');
                ?>
            </div>
            <div class="container-fluid" id="iddivbody" style="padding-bottom: 10px; padding-top: 10px">                               

                <div align="center" id="cargando_central" style="margin-bottom: 20%; margin-top: 30%" hidden=""></div>

                <div id="contenedor_central" style="margin-bottom: 20%; margin-top: 20%">
                    <?php
                    echo Modules::run('central/centro');
                    //echo Modules::run('predictivo/centro');
                    ?> 
                </div>
                <div id="contenedor_inferior">

                </div>

            </div>
            <div id="contenedor_footer" class="navbar-fixed-bottom">
                <?php
                /*
                 * footer de sistema 
                 */
                echo Modules::run('frontend/end');
                ?> 
            </div>

        </div>
        <input type="hidden" id="url_b" name="url_b" value="<?= base_url() ?>">
    </body>
</html>