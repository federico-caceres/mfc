<?php
/*
 * Esta vista muestra el login de la aplicacion.
 */
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema del MFC Paraguay</title>  

        <script type="text/javascript" src="<?php echo base_url() . 'assets/jquery/jquery-2.1.3.min.js'; ?>"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/pnotify/pnotify.custom.min.js"></script>
<!--        <script type="text/javascript" src="<?php //echo base_url() . 'assets/jquery/jquery.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php //echo base_url() . 'assets/jquery/jquery-2.1.3.min.js'; ?>"></script>-->
        <script type="text/javascript" src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/js/login.js'; ?>"></script>
        <!-- estilos css -->
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() . 'assets/img/favicon.png' ?>">
        <link href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.css'; ?>" type="text/css" rel="stylesheet" />        
        <link href="<?php echo base_url() . 'assets/css/main.css'; ?>" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/pnotify/pnotify.custom.min.css'; ?>">
        <!-- estilos css -->


        <script type="text/javascript">
            var base_url = '<?php echo BASE_URL; ?>';
        </script>
    </head>
    <body id="login" class="col-sm-12 wrapper-ppal">

        <div id="contenidoLogin">

            <!-- Login 
            ////////////////////////////////////-->
            <div id="loading"></div>
            <div id="box-login">

                <img src="assets/img/logo.png" data-sr="enter bottom over 1.5s and move 130px">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="glyphicon glyphicon-lock"></i> Ingrese su usuario y contraseña</h3>
                    </div>
                    <div class="panel-body" style="text-align: center;">
                        <form id="idFormLogin"  method="post" class="form-horizontal" accept-charset="UTF-8" role="form">
                            <fieldset>                           
                                <small id="idmsg" class="text-error warning text-danger" hidden=""></small>
                                <div class="form-group input-group-lg">
                                    <input type="text"  class="form-control" id="id_user" name="nm_usuario" placeholder="Usuario ...">
                                </div>

                                <div class="form-group input-group-lg" id="clcontrasenha">                           
                                    <input type="password" name="nm_clave" class="form-control" id="id_passw" placeholder="Contraseña ...">                                    

                                </div>

                                <div class="row"> 
                                    <div class="col-sm-12">
                                        <button class="btn btn-lg bg-primary btn-block" type="submit">Aceptar</button>
                                    </div>

                                </div>

                                <div class="row" >                                     
                                    <div class="col-sm-12 login_legend">
                                        <h3 class="panel-title">MFC Paraguay</h3>
                                    </div>
                                </div>                            
                                <?php
                                if ($msg != "") {
                                    echo "<div class='row' >                                     
                                    <div class='col-sm-12 login_legend'>
                                        <h3 class='panel-title' style='color: red'>" . $msg . "</h3>
                                    </div>
                                </div>";
                                } else {
                                    echo "<div class='row' >                                     
                                    <div class='col-sm-12 login_legend'>
                                        <h3 class='panel-title'></h3>
                                    </div>
                                </div>";
                                }
                                ?>

                            </fieldset>
                            <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>"/>
                        </form>
                        <form id="idform"  method="post" class="form-horizontal" action="<?php echo base_url() . 'principal'; ?>" >
                            <input type="hidden" name="userData" id="userData" />
                            <input type="hidden" name="selectData" id="selectData" />
                            <input type="hidden" name="selectInfo" id="selectInfo" />
                        </form>
                    </div>
                </div>
            </div><!--endBoxLogin-->

        </div><!--endWrapperppal-->

        <!-- javascript -->

        <script type="text/javascript" src="<?php echo base_url() . 'assets/js/scrollReveal.min.js'; ?>"></script>

        <script>
            notificacion('Advertencia', '<?= $msg ?>', 'error', 5000);
            window.sr = new scrollReveal();

        </script>

    </body>
</html>