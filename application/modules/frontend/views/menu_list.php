<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
$userData = $this->session->userdata('userData');
?>

<!--<div id="wrapper">

     Navigation 
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
         Brand and toggle get grouped for better mobile display 
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Sistema de Membresía MFC PARAGUAY </a>
        </div>
         Top Menu Items 
        <ul class="navbar-brand navbar-right top-nav">
                                        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <?= $userData->nombre ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li id="menuUsuarios">
                    <a href="#"><i class="glyphicon glyphicon-user"></i> Usuarios</a>
                </li>
                <li class="divider"></li>
                <li id="menuCambiaPassword">
                    <a href="#"><i class="glyphicon glyphicon-lock"></i> Cambiar Clave</a>
                </li>
                <li class="divider"></li>
                <li id="menuLogout">
                    <a href="#"><i class="glyphicon glyphicon-log-out"></i> Salir</a>
                </li>
            </ul>
            </li>
        </ul>  
         Sidebar Menu Items - These collapse to the responsive navigation menu on small screens 
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="#" id="btn_inicio"><i class="glyphicon glyphicon-home"></i> Inicio</a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-education"></i> Matrimonios</a>
                    <ul class="dropdown-menu">
                        <li  id="menuMatrimonios">
                            <a href="#"><i class="glyphicon glyphicon-plus-sign" style="color: #204d74"></i> ABM de Matrimonios</a>
                        </li>
                        <li class="divider"></li>
                        <li id="menuGrupos">
                            <a href="#"><i class="glyphicon glyphicon-plus-sign" style="color: #204d74"></i> ABM de Grupos</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" target="principal"><i class="glyphicon glyphicon-adjust"></i> Jóvenes</a>
                </li>
                <li>
                    <a href="#" target="principal"><i class="glyphicon glyphicon-list"></i> Lista de Miembros</a>
                </li>
            </ul>
        </div>
         /.navbar-collapse 
    </nav>

     /#page-wrapper 

</div>-->