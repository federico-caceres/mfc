<?php
    $userData = $this->session->userdata('userData');
    $nivel = $userData->nivel;
?>
<div class="row d-flex justify-content-center" id="contenedorSuperiorReporte">
    <div style="text-align: center">
        <h2>Cantidad de Matrimonios</h2>
    </div>
    
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th class="h5" scope="col"><strong> Orden</strong></th>
                    <th class="h5" scope="col"><strong> Arqui/Diócesis</strong></th>
                    <th class="h5" scope="col"><strong> Cantidad de matrimonios</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (isset($cantidades) && sizeof($cantidades) > 0) {
                        $c=1;
                        foreach ($cantidades as $key => $cant) {
                            ?>
                            <tr class="odd gradeX">
                                <td class="h5"><?= $c ?></td>
                                <a href="#">
                                    <td class="h5"><?= $cant->nombre ?></td>
                                </a>
                                <td class="h4"><span class="label label-primary"><?= $cant->cant ?></span></td>
                            </tr> 
                            <?php
                            $c++;
                        }
                    }
                    ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-3"></div>
    
</div>

    <div class="row" style="text-align: center">
        <h3>Total: <span class="label label-success">
            <?= $total[0]->cant ?></span>
        </h3> 
    </div>


