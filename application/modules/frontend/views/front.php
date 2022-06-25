<?php
/*
 * En este script se emplementa la vista del header
 */
?>
<!--<script type="text/javascript" src="<?= base_url() ?>assets/js/menu.js"></script>-->

<?php
$userData = $this->session->userdata('userData');
$nivel = $userData->nivel;
$cargo = $userData->cargo;
$muestra = ($cargo == "6") ? "hidden" : "";
$muestraGrupo = ($cargo != "2" && $cargo != "6") ? "hidden" : "";
$muestraBase = ($nivel == "3") ? "hidden" : "";
?>

<div id="wrapper">
    <div id="div_contenedor_menu" style="float: right">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a id="tituloMenu" class="navbar-brand" href="#">MFC PARAGUAY - <?= ($userData->iddiocesis === "100") ? 'Equipo Nacional' : ($userData->nivel === "2") ? $userData->diocesis : $userData->bases; ?> </a>
            </div>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="#" id="btn_inicio"><i class="glyphicon glyphicon-home"></i> Inicio</a>
                    </li>
                    <li class="<?= $muestra ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-education"></i> Matrimonios</a>
                        <ul class="dropdown-menu">
                            <li  id="menuMatrimonios">
                                <a href="#"><i class="glyphicon glyphicon-plus-sign" style="color: #204d74"></i> ABM de Matrimonios</a>
                            </li>
                            <li class="divider"></li>
                            <li  id="menuS07">
                                <a href="#"><i class="glyphicon glyphicon-plus-sign" style="color: #204d74"></i> Matrimonios con S07</a>
                            </li>
                            <li class="divider"></li>
                            <li id="menuGrupos">
                                <a href="#"><i class="glyphicon glyphicon-plus-sign" style="color: #204d74"></i> ABM de Equipos</a>
                            </li>
                            <li class="divider <?= $muestraBase?>"></li>
                            <li id="menuBases" class="<?= $muestraBase?>">
                                <a href="#"><i class="glyphicon glyphicon-plus-sign" style="color: #204d74"></i> ABM de Bases</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-education"></i> Jóvenes</a>
                        <ul class="dropdown-menu">
                            <li  id="menuJovenes">
                                <a href="#"><i class="glyphicon glyphicon-plus-sign" style="color: #204d74"></i> ABM de Jovenes</a>
                            </li>
                            <li class="divider <?= $muestraGrupo ?>"></li>
                            <li class="<?= $muestraGrupo ?>" id="menuGruposJovenes">
                                <a href="#"><i class="glyphicon glyphicon-plus-sign" style="color: #204d74"></i> ABM de Equipos</a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-download"></i> Reportes</a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-submenu">
                                <a tabindex="-1" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-education"></i> Jóvenes</a>
                                <ul class="dropdown-menu">
                                    <li  id="menuSJ09">
                                        <a tabindex="-1" href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> SJ-09</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="menuCuadranteJuvenil">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> Cuadrante</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="divider"></li>
                            <li class="dropdown-submenu" <?= $muestra ?>>
                                <a tabindex="-1" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-education"></i> Matrimonios</a>
                                <ul class="dropdown-menu">
                                    <li  id="menuS09">
                                        <a tabindex="-1" href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> S-09</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="menuCuadrante">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> Cuadrante</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="menuCuadranteMiembros">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> Cuadrante Membresia</a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-download"></i> Formularios</a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-submenu">
                                <a tabindex="-1" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-education"></i> Jóvenes</a>
                                <ul class="dropdown-menu">
                                    <li  id="sj01">
                                        <a tabindex="-1" href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> SJ-01</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="sj02">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> SJ-02</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="sj03">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> SJ-03</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="sj04">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> SJ-04</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="sj05">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> SJ-05</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="sj06">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> SJ-06</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="sj07">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> SJ-07</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="sj08">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> SJ-08</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="sj09">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> SJ-09</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="sj10">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> SJ-10</a>
                                    </li>

                                </ul>
                            </li>
                            <li class="divider"></li>
                            <li class="dropdown-submenu" <?= $muestra ?>>
                                <a tabindex="-1" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-education"></i> Matrimonios</a>
                                <ul class="dropdown-menu">
                                    <li  id="s01">
                                        <a tabindex="-1" href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> S-01</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="s02">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> S-02</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="s03">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> S-03</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="s04">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> S-04</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="s05">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> S-05</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="s06">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> S-06</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="s07">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> S-07</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="s08">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> S-08</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="s09">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> S-09</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="s10">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> S-10</a>
                                    </li>

                                </ul>
                            </li>
                            <li class="divider"></li>
                            <li class="dropdown-submenu">
                                <a tabindex="-1" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-education"></i> Legales</a>
                                <ul class="dropdown-menu">
                                    <li  id="estatuto">
                                        <a tabindex="-1" href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> Estatuto</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li id="reglamento">
                                        <a href="#"><i class="glyphicon glyphicon-file" style="color: #204d74"></i> Reglamento</a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right side-nav">
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
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <!-- /#page-wrapper -->
    </div>
</div>
