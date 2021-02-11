<table class="display hover row-border" id="tabla_kpi" cellspacing="0" style="width:100%;">
    <thead>
        <tr style="background:#29a4dd;color:#fff">
            <th>Id</th>
            <th>Titulo</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php

                $total_x=count($datos);
                $row=0;
                while ($row< $total_x) {
                    ?>
            <tr>
                <td>
                    <?php echo $datos[$row] ['id']; ?>
                </td>
                <td>
                    <?php echo $datos[$row] ['tittle']; ?>
                </td>
                <td>
                    <?php echo $datos[$row] ['description']; ?>
                </td>
                <td>
                    <div class="row_buttons">

                        <button class="btn btn-warning" type="button" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
                            <div onClick="
                            <?php
                              echo "get_data_update('kpi',".$datos[$row]['id'].");"
                            ?>"
                            ><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></div>
                        </button>
                        <button class="btn btn-danger" type="button" onClick="<?php $str=Yii::app()->baseUrl; echo "deleteObject('kpi',".$datos[$row] ['id'].")" ?>" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
                            <i class="fa fa-trash-o" aria-hidden="true" style="padding:4px;"></i>
                        </button>

                    </div>
                </td>

            </tr>

            <?php
                    $row++;
                } ?>
    </tbody>
</table>
<script type="text/javascript">
    $(document).ready(function () {

        var table = $('#tabla_kpi').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
            "pagingType": "simple",
            "scrollX": "500",
            "processing": true,
            "autoWidth": true,
            "info": true,
            "responsive": true

        });


        $('#tabla_kpi tbody').on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                var value=$(this).find('td:first').html();
                value=$.trim(value);
                loadKPIOBS(value);
            }
        });

    });
</script>
