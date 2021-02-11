    <table class="display hover row-border" id="table_lender" cellspacing="0" style="width:100%;">
        <thead>
            <tr style="background:#29a4dd;color:#fff">
                <th>Id</th>
                <th>Nombre del Accionista</th>
                <th>Derechos de Votación</th>
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
                        <span>
                        <?php echo $datos[$row] ['id']; ?>
                        </span>
                    </td>
                    <td>
                        <span>
                        <?php echo $datos[$row] ['shareholder_name']; ?>
                        </span>
                    </td>
                    <td>
                        <span>
                        <?php echo $datos[$row] ['votingRights']; ?>
                        </span>
                    </td>
                    <td>
                        <div class="row_buttons">
                           

                            <div class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;" onClick=" 
                            <?php 
                              echo "get_data_update('lender',".$datos[$row]['id'].");" 
                            ?>" 
                            ><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></div>

                            <button class="btn btn-danger" type="button" onClick="<?php $str=Yii::app()->baseUrl; echo "deleteObject('lender',".$datos[$row] ['id'].")" ?>" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
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

            var table = $('#table_lender').DataTable({
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
            $('#table_lender tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

        });

        
    </script>