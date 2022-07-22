<table id="tablaCursosMatrimonios" class="table table-striped responsive">
    <thead>
        <tr>
            <th style="width: 20%;">Matrimonio</th>
            <th style="width: 20%;">Diocesis</th>
            <th style="width: 20%;">Base</th>
            <th style="width: 20%;">Grupo</th>
            <th style="width: 20%;">Curso</th>
            <th style="width: 20%;">Fecha</th>
            <th style="width: 20%;">Lugar</th>
        </tr>
    </thead>

    <tbody> <?php
        if (isset($data) && sizeof($data) > 0) {
            foreach ($data as $key => $value) {
                ?>
                <tr class="odd gradeX">
                    <td><?= $value->matrimonio ?></td>
                    <td><?= $value->diocesis ?></td>
                    <td><?= $value->base ?></td>
                    <td><?= $value->grupos ?></td>
                    <td><?= $value->curso ?></td>
                    <td><?= $value->fecha ?></td>
                    <td><?= $value->lugar ?></td>
                </tr> 
                <?php
            }
        }
        ?>
    </tbody>
</table>