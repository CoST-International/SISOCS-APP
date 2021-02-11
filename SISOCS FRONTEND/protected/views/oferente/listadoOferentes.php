
<?php

    $id=isset($_GET['id']) ? $_GET['id'] : '0';

    $rows = Yii::app()->db->createCommand("SELECT cs_oferente.idOferente, cs_oferente.nombre_oferente,count(cs_oferente.idOferente) AS cuantos , sum(`precioUSD`) AS monto FROM cs_contratacion JOIN cs_oferente ON cs_oferente.idOferente=cs_contratacion.idOferente WHERE cs_contratacion.estado = 'PUBLICADO' GROUP BY idOferente HAVING cuantos =".($id))->queryAll() 
   
?>



<table class="display hover row-border" id="tabla_contrato_referente" cellspacing="0" style="width:100%;">
    <thead>
        <tr style="background:#16a085;color:#fff">
            <th>Id Oferente</th>
            <th>Nombre del Oferente</th>
            <th>Cuantos</th>
            <th>Monto</th>
        </tr>
    </thead>

    <tbody>

        <?php 
            foreach ($rows as $row) {
        ?>
        <tr>
            <td>
                <?php echo $row['idOferente'] ?>
            </td>
            <td>
                <?php echo $row['nombre_oferente'] ?>
            </td>
            <td>
                <?php echo $row['cuantos'] ?>
            </td>
            <td>
                <?php echo $row['monto'] ?>
            </td>
        </tr>

        <?php
            }
        ?>
    </tbody>
</table>

<script type="text/javascript">
  

    $(document).ready(function () {

        $('#tabla_contrato_referente').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
            "pagingType": "simple",
            "scrollX": "500",
            "processing": true,
            "autoWidth": true,
            "serverSide": false,
            "info": true,
            "responsive": true

        });

    });

    

</script>