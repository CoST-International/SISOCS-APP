<table class="display hover row-border" id="tabla_oferentes" cellspacing="0" style="width:100%;">
        <thead>
            <tr style="background:#29a4dd;color:#fff">
                
                <th>Oferente</th>
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
                        <?php  echo $this->nombreOferente($datos[$row] ['idOferente']); ?>
                        </span>
                    </td>
                    <td>
                        <div class="row_buttons">


                            

                            <button class="btn btn-danger" type="button" onClick="<?php $str=Yii::app()->baseUrl; echo "deleteOferente(".$datos[$row] ['idCalificacion'].",".$datos[$row] ['idOferente'].")" ?>" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
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

            var table = $('#tabla_oferentes').DataTable({
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
            $('#tabla_oferentes tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

        });

        deleteOferente = function (idCalificacion,id) {

            var controller='<?php echo CController::createUrl("/calificacionOferente/ViewDetOferentes", array("event"=>"Update")); ?>';
            const url =controller+"&id="+idCalificacion;

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
                        'type': 'GET',
                        
                        'url': '/SISOCS/index.php?r=calificacion/DeleteFuenteGet&0[idCalificacion]='+idCalificacion+'&0[idOferente]='+id,
                        'cache': false,
                        'success': function (data) {
                            $('#filas_oferentes').load(url);
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
