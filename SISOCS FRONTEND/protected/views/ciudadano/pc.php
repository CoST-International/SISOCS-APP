<div class="informe_sistema">
    <div class="" style="background:#fff;">
        <h1 class="section-title wow fadeIn animated" data-wow-delay=".2s">
            Descarga de informacion de proyectos y contratos
        </h1>
        <p class="section-subcontent"></p>
        <hr class="lineOne">
        <div class="col-sm-12 col-md-12 col-xs-12" style="padding-bottom: 50px;">
            <table class="display hover row-border" id="tabla_descarga" cellspacing="0" style="width:100%;">
                <thead>
                    <tr style="background:#29a4dd;color:#fff">
                        <th>Código Proyecto</th>
                        <th>Proyecto Nombre</th>
                        <th>Calificación</th>
                        <th>Contratación LPS</th>
                        <th>Contratación USD</th>
                        <th>Contratación Fecha Inicio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                            $rawData = Yii::app()->db->createCommand("SELECT * FROM vProyecto_Contrato")->queryAll();
                            $count = Yii::app()->db->createCommand('SELECT COUNT(*) as counter_alias FROM vProyecto_Contrato')->queryScalar();
                            $row=0;
                            $total_x=count($rawData); 
                            
                            while($row< $total_x) {
                                ?>
                        <tr>
                            <td>
                                <?php echo $rawData[$row] ['proyecto_codigo']; ?>
                            </td>
                            <td>
                                <?php echo $rawData[$row] ['proyecto_nombre']; ?>
                            </td>
                            <td>
                                <?php echo $rawData[$row] ['calificacion_numero']; ?>
                            </td>
                            <!--td>
                                <?php  /* echo $rawData[$row] ['contratacion_oferente'];*/ ?>
                            </td-->
                            <td>
                                <?php echo $rawData[$row] ['contratacion_precioLPS']; ?>
                            </td>
                            <td>
                                <?php echo $rawData[$row] ['contratacion_precioUSD']; ?>
                            </td>
                            <td>
                                <?php echo $rawData[$row] ['contratacion_fecha_inicio']; ?>
                            </td>
                        </tr>
                        <?php $row++;
                    } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        var table = $('#tabla_descarga').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
            "pagingType": "simple",
            "scrollX": "500",
            "processing": true,
            "info": true,
            "responsive": true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    text: '<i class="fa fa-files-o"></i>',
                    titleAttr: 'Copy',
                    exportOptions: {
                        //columns: [1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'csv',
                    text: '<i class="fa fa-file-text-o"></i>',
                    titleAttr: 'CSV',
                    exportOptions: {
                        //columns: [1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'excel',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    titleAttr: 'Excel',
                    exportOptions: {
                        //columns: [1, 2, 3, 4, 5, 6, 7]
                    }
                }, {
                    extend: 'pdfHtml5',
                    pageSize: 'A4',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    titleAttr: 'PDF',
                    exportOptions: {
                        //columns: [1, 2, 3, 4, 5, 6, 7]
                    }, customize: function (doc) {
                        doc.content.splice(1, 0, {
                            margin: [0, 0, 0, 0],
                            alignment: 'center',
                            image: 'data:image/png;base64,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'
                        });
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        //columns: [1, 2, 3, 4, 5, 6, 7]
                    },
                    text: '<i class="fa fa-print"></i>',
                    titleAttr: 'Imprimir',
                },
                {
                    extend: 'colvis',
                    text: '<i class="fa fa-eye"></i>',
                    titleAttr: 'Visivilidad',
                    //columns: [1, 2, 3, 4, 5, 6, 7]
                },
            ],
            lengthChange: false,

        });
        jQuery('#tabla_descarga_paginate').addClass('table-responsive');

    });

</script>