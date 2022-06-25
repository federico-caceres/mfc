<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Plataforma Saliente</title>  

        <script type="text/javascript" src="<?php echo base_url() . 'assets/jquery/jquery-2.1.3.min.js'; ?>"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/pnotify/pnotify.custom.min.js"></script>
        <!-- estilos css -->
        <link href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.css'; ?>" type="text/css" rel="stylesheet" />        
        <link href="<?php echo base_url() . 'assets/css/main.css'; ?>" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/pnotify/pnotify.custom.min.css'; ?>">
        <!-- estilos css -->


        <script type="text/javascript">
            var base_url = '<?php echo BASE_URL; ?>';
        </script>
    </head>
    <body id="webservice">
        <div style="text-align: center">
            <h1 class="center">Webservices de Celiter</h1>
        </div>
        <div id="contenedor_central" style="margin-top: 70px;margin-bottom: 50px">
            <div class="row" style="min-height: 750px; border: 1px solid #FAFAFA;background: #F2F2F2; padding: 50px; border-radius: 18px 18px 19px 18px; -moz-border-radius: 18px 18px 19px 18px; -webkit-border-radius: 18px 18px 19px 18px">

                <div class="col-sm-12 text-center"><img src="<?php echo base_url() . 'assets/img/logo-skytel.png' ?>"></div>
                <div class="row" style="padding: 50px;">
                    <div class="col-sm-12 text-center">
                        <h3> Sistema de Gestión Salientes</h3>
                    </div>
                </div>
                <div style="text-align: center">
                    <h3>Lista de Métodos</h3>
                    <li><a href='<?php echo base_url()."api/index/textContact?method=1"?>'> addContact</a></li>
                    <li><a href='<?php echo base_url()."api/index/textContact?method=2"?>'> addContactCola</a></li>
                    <li><a href='<?php echo base_url()."api/index/textContact?method=3"?>'> getGestionInfo</a></li>
                </div>
                
            </div>

        </div>
        <div id="contenedor_footer" class="col-sm-12 navbar-fixed-bottom">
            <?php
            /*
             * footer de sistema 
             */
            echo Modules::run('frontend/end');
            ?> 
        </div>
        <!-- javascript -->
        <script type="text/javascript" src="<?php echo base_url() . 'assets/jquery/jquery.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/jquery/jquery-2.1.3.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.js'; ?>"></script>


    </body>
</html>
