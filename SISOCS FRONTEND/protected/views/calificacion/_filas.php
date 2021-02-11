    <table class="display hover row-border" id="tabla_admin" cellspacing="0" style="width:100%;">
        <thead>
            <tr style="background:#29a4dd;color:#fff">
                <th>Id</th>
                <th>Titulo</th>
                <th>Descripcion</th>
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
                        <a href="<?php echo $datos[$row] ['url']; ?>" target="_blank"><?php echo $datos[$row] ['title']; ?></a>
                        </span>
                    </td>
                    <td>
                        <span>
                        <?php echo $datos[$row] ['description']; ?>
                        </span>
                    </td>
                    <td>
                        <div class="row_buttons">


                            <div class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"  onClick="
                            <?php
                              echo "get_data_update(".$datos[$row]['id'].");"
                            ?>"
                            ><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></div>

                            <button class="btn btn-danger" type="button" onClick="<?php $str=Yii::app()->baseUrl; echo "deleteObject(".$datos[$row] ['id'].")" ?>" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
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

            var table = $('#tabla_admin').DataTable({
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
            $('#tabla_admin tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

        });

        deleteObject = function (id) {

            var controller='<?php echo CController::createUrl("tenderDocuments/delete"); ?>';
            const url =controller+"&id="+id;

            swal({
                title: '¿Desea eliminar el registro con código : ' + id + ' ?',
                text: "No se podrá recuperar en un futuro",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, ¡Borrar!',
                cancelButtonText: 'No, ¡Mantener!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {

                if (result) {

                    jQuery.ajax({
                        'type': 'POST',
                        'data': {
                            'id': id
                        },
                        'url': url,
                        'cache': false,
                        'success': function (data) {
                            loadDocuments();
                            table.row('.selected').remove().draw(false);
                            swal(
                                '¡Borrado!',
                                'El registro ha sido eliminado',
                                'success'
                            )
                        },
                        'error:':function(error){

                            swal(
                                'Error!',
                                'El registro NO ha sido eliminado',
                                'error'
                            )
                        }
                    });
                } else if (result.dismiss === 'cancel') {
                    swal(
                        '¡Cancelado!',
                        'El registro está seguro',
                        'error'
                    )
                }
            }).catch(swal.noop)
    }
    </script>
