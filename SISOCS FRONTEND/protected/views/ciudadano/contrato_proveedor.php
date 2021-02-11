<div class="contrato_proveedor">
<h1 class="section-title wow fadeIn animated" data-wow-delay=".2s">
        Contratos y Proveedores
    </h1>
    <hr style="border-top: 2px solid #29a4dd;width:5%;">
    <div class="contratosGraph">
        <div class="row">
            <div class="col-md-6 col-x-12 col-sm-12" style="background:#f3f3f3;margin-top:20px">
                <?php



            $rows = Yii::app()->db->createCommand(" SELECT cuantos AS 'contratos', count(*) AS 'proveedores', sum(monto) AS 'suma'
                                                    FROM (
                                                        SELECT idEntidad, count(idEntidad) AS cuantos , sum(`precioLPS`) AS monto
                                                        FROM cs_contratacion
                                                        WHERE cs_contratacion.estado = 'PUBLICADO'
                                                        GROUP BY idEntidad
                                                        ) T
                                                    GROUP BY cuantos ")->queryAll();

            $cuantos    = array();
            $suma       = array();
            $categorias = array();
            $total      = 0;

            foreach ($rows as $row) {
                $total += $row['suma'] * 1.00;
            }

            foreach ($rows as $row) {
                if ($row['contratos'] == 1) {
                    $x = ' contrato';
                } else {
                    $x = ' contratos';
                }
                if ($row['proveedores'] == 1) {
                    $y = '1 proveedor';
                } else {
                    $y = $row['proveedores'].' proveedores';
                }
                array_push($categorias, $row['contratos'] . $x);
                array_push($cuantos, $row['proveedores'] * 1);
                if ($total > 0) {
                    $suma[] = array(
                                    'con '.$row['contratos'].$x.',<br/>'.$y.'<br/>'.number_format($row['suma'], 2, '.', ','),
                                    ($row['suma'] * 1.00) / $total
                                );
                }
            }

            $this->Widget('ext.highcharts.HighchartsWidget', array(
                'id' => 'HBarEstratificacion',
                'options' => array(
                    'chart' => array(
                        'defaultSeriesType' => 'bar',
                        'style' => array(
                            'fontFamily' => 'Verdana, Arial, Helvetica, sans-serif'
                        )
                    ),
                    'title' => array(
                        'text' => 'Estratificacion segun contratos obtenidos por un proveedor'
                    ),
                    'xAxis' => array(
                        'title' => array(
                            'text' => 'Contratos obtenidos por un solo proveedor'
                        ),
                        'categories' => $categorias,
                        'labels' => array(
                            'step' => 1,
                            'rotation' => 0,
                            'y' => 20
                        )
                    ),
                    'yAxis' => array(
                        'title' => array(
                            'text' => 'Casos'
                        )
                    ),
                    'series' => array(
                        array(
                            'name' => 'Numero de ocurrencias o cantidad de casos',
                            'data' => $cuantos,
                            'shadow' => false
                        )
                    )
                )
            ));
            ?>
            </div>
            <div class="col-md-6 col-x-12 col-sm-12" style="background:#fff;margin-top:20px">


                <?php
            $this->Widget('ext.highcharts.HighchartsWidget', array(
                'options' => array(
                    'gradient' => array(
                        'enabled' => true
                    ),
                    'credits' => array(
                        'enabled' => false
                    ),
                    'exporting' => array(
                        'enabled' => false
                    ),
                    'chart' => array(
                        'plotBackgroundColor' => null,
                        'backgroundColor' => 'transparent',
                        'plotBorderWidth' => null,
                        'plotShadow' => false,

                    ),
                    'legend' => array(
                        'enabled' => false
                    ),
                    'title' => array(
                        'text' => 'Montos adjudicados por categoria'
                    ),
                    'tooltip' => array(
                        'pointFormat' => '{point.percentage:.1f}%'
                    ),
                    'plotOptions' => array(
                        'pie' => array(
                            'allowPointSelect' => true,
                            'cursor' => 'pointer',
                            'dataLabels' => array(
                                'enabled' => true,
                                'color' => '#000000',
                                'connectorColor' => '#000000',
                                'format' => '<b>{point.name}</b>'
                            )
                        )
                    ),
                    'series' => array(
                        array(
                            'type' => 'pie',
                            'name' => 'Total adjudicado',
                            'data' => $suma
                        )
                    )
                )
            ));
            ?>

            </div>
        </div>
    </div>
    <div class="row" style="margin-top:50px;">
        <h1 class="section-title wow fadeIn animated" data-wow-delay=".2s">
            Tabla Proveedores
        </h1>
        <hr style="border-top: 2px solid #29a4dd;width:5%;">
        <p class="section-subcontent">
            Click en
            <b> Ver Detalle</b> para cargar los detalles</p>
        <hr class="lineOne">
        <div class="col-md-6 col-x-12 col-sm-12" style="border: 1px solid #f5f5f5;border-radius:2px;color:#141414;padding:10px">
            <h3 style="text-align:center">
                Tabla de Contratos
                <hr>
            </h3>
            <table class="display hover row-border" id="tabla_contrato_proveedor" cellspacing="0" style="width:100%;">
                <thead>
                    <tr style="background:#29a4dd;color:#fff">
                        <th>Contratos obtenidos por proveedor</th>
                        <th>Proveedor en Categoría</th>
                        <th>Monto adjudicado en esta categoría</th>
                        <th>Detalle</th>
                    </tr>
                </thead>

                <tbody>

                    <?php 
             foreach ($rows as $row) {
                 $contratos=$row['contratos']; ?>
                    <tr>
                        <td style="background:#7f8c8d;color:#fff;font-weight:bold;font-size:1.1em">
                            <?php 
                               
                               echo $contratos.'<div style="float:right">'.$x.'</div>'; ?>
                        </td>
                        <td>
                            <?php echo $row['proveedores'] ?>
                        </td>
                        <td>
                            <?php echo "LPS.".number_format($row['suma'], 2, '.', ','); ?>
                        </td>
                        <td>
                            <?php echo CHtml::Button('Ver Detalles', array('class' => 'hvr-grow', 'id'=>'tableButton','onClick'=>"loadOferentes(".$contratos.")")); ?>
                        </td>
                        </td>
                    </tr>

                    <?php
             }?>
                </tbody>
            </table>
        </div>
        <div class="col-md-6 col-x-12 col-sm-12" style="border: 1px solid #f5f5f5;border-radius:2px;background:#f3f3f3;color:#141414;padding:10px">
            <h3 style="text-align:center">
                Detalle Oferente
                <hr>
            </h3>
            <div id="oferentes"></div>

        </div>
    </div>
</div>
<script type="text/javascript">
    /* $(".clicked").click(function (evt) {
         window.location.href = "http://67.207.88.38/index.php?r=/oferente/listadoOferentes&id=" + $(this).attr("id");
     });*/

    $(document).ready(function () {

        $('#tabla_contrato_proveedor').DataTable({
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
        loadOferentes(0);
    });

    function loadOferentes(id) {
        jQuery.ajax({
            'type': 'POST',
            'data': {
                'id': id
            },
            'url': 'index.php?r=oferente/listadoOferentes&id=' + id,
            'cache': false,
            'success': function (html) {
                jQuery("#oferentes").html(html);
            }
        });
    }

</script>