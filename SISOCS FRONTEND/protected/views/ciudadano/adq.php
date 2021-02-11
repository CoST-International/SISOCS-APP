<?php



$data_rows = Yii::app()->db->createCommand("SELECT
                                        	cs_tipocontrato.contrato,
                                        	cs_metodo.adquisicion,
                                          cs_calificacion.idMetodo,
                                          cs_calificacion.idTipoContrato,
                                        	COUNT(cs_metodo.adquisicion) AS 'contrato_cuantos'
                                        FROM cs_calificacion INNER JOIN cs_metodo ON
                                        	cs_calificacion.idMetodo = cs_metodo.idMetodo INNER JOIN cs_tipocontrato ON 			cs_calificacion.idTipoContrato = cs_tipocontrato.idTipoContrato
                                        WHERE cs_calificacion.estado = 'PUBLICADO'
                                        GROUP BY cs_calificacion.idTipoContrato,
                                        	cs_calificacion.idMetodo ")->queryAll();


$cat_rows = Yii::app()->db->createCommand(" SELECT DISTINCT
                                                	cs_tipocontrato.contrato
                                                FROM cs_calificacion INNER JOIN cs_metodo ON
                                                	cs_calificacion.idMetodo = cs_metodo.idMetodo INNER JOIN cs_tipocontrato ON 			cs_calificacion.idTipoContrato = cs_tipocontrato.idTipoContrato
                                                WHERE cs_calificacion.estado = 'PUBLICADO' ")->queryAll();

$adq_rows = Yii::app()->db->createCommand(" SELECT DISTINCT
												cs_metodo.adquisicion
											FROM cs_calificacion INNER JOIN cs_metodo ON
												cs_calificacion.idMetodo = cs_metodo.idMetodo INNER JOIN cs_tipocontrato ON 			cs_calificacion.idTipoContrato = cs_tipocontrato.idTipoContrato
											WHERE cs_calificacion.estado = 'PUBLICADO' ")->queryAll();

$series = array();
$categories = array();
$data   = array();
$metodo = array();
$metodo_pie = array();
$found = false;
$total =0;
$porcentaje = 0;

foreach ($cat_rows as $cat) {
    $categories[] = $cat['contrato'];
}

foreach ($adq_rows as $adq) {
    foreach ($cat_rows as $cat) {
        $found = false;
        foreach ($data_rows as $row) {
            if (($cat['contrato'] == $row['contrato']) && ($adq['adquisicion'] == $row['adquisicion'])) {
                $data[] = $row['contrato_cuantos']*1;
                $found = true;
            }
        }
        if (!$found) {
            $data[] = 0;
        }
    }
    $series[] = array('type'=>'column', 'name'=>$adq['adquisicion'], 'data'=>$data);
    unset($data);
}

foreach ($adq_rows as $adq) {
    $metodo[] = array($adq['adquisicion'],0,0);
}
for ($i=0;$i<count($metodo);$i++) {
    $porcentaje = 0;
    foreach ($data_rows as $row) {
        if ($metodo[$i][0] == $row['adquisicion']) {
            $porcentaje += $row['contrato_cuantos']*1;
        }
    }
    $metodo[$i][1] = $porcentaje;
    $metodo[$i][2] = 'js:Highcharts.getOptions().colors['.$i.']';
    $total += $porcentaje;
}
for ($i=0;$i<count($metodo);$i++) {
    if ($total > 0) {
        $metodo[$i][1] = $metodo[$i][1]/$total;
    }
}
for ($i=0;$i<count($metodo);$i++) {
    $metodo_pie[] = array('name'=>$metodo[$i][0], 'y'=>$metodo[$i][1], 'color'=>$metodo[$i][2]);
}

$series[] = array(
                            'type' => 'pie',
                            'name' => 'Metodo de adquisicion',
                            'tooltip' => array('pointFormat' => '{point.percentage:.1f}%'),
                            'data' => $metodo_pie,
                            'center' => array(100, 60),
                            'size' => 100,
                            'showInLegend' => false,
                            'dataLabels' => array(
                                'enabled' => false,
                            ),
                        );
?>
    <div class="ciudadano_adq">
    <h1 class="section-title wow fadeIn animated" data-wow-delay=".2s">
            Gráficas
        </h1>
        <hr style="border-top: 2px solid #29a4dd;width:5%;">
        <?php
$this->widget('ext.highcharts.HighchartsWidget', array(
    'scripts' => array(
        'modules/exporting'
    ),
    'options' => array(
        'title' => array(
            'text' => 'Tipo de Contrato vs. Método de Adquisición',
        ),
        'xAxis' => array(
            'categories' => $categories,
        ),
        'yAxis' => array(
            'title' => array(
                'text' => 'Casos'
            )
        ),
        'labels' => array(
            'items' => array(
                array(
                    'html' => 'Metodos de adquisicion utilizados',
                    'style' => array(
                        'left' => '40px',
                        'top' => '10px',
                        'color' => 'js:(Highcharts.theme && Highcharts.theme.textColor) || \'black\'',
                    ),
                ),
            ),
        ),
        'series' => $series,
    )
));
?>
    </div>
    <div class="ciudadano_adq_table">
    <h1 class="section-title wow fadeIn animated" data-wow-delay=".2s">
            Tabla de Adquisiciones
        </h1>
        <hr style="border-top: 2px solid #29a4dd;width:5%;">
        <?php 
        $this->widget("AdquisicionesWidget");
       /* $sql = "SELECT
        cs_tipocontrato.contrato,
        cs_metodo.adquisicion,
        cs_calificacion.idMetodo,
        cs_calificacion.idTipoContrato,
        COUNT(cs_metodo.adquisicion) AS 'contrato_cuantos'
    FROM cs_calificacion INNER JOIN cs_metodo ON
        cs_calificacion.idMetodo = cs_metodo.idMetodo 
        INNER JOIN cs_tipocontrato ON 
        cs_calificacion.idTipoContrato = cs_tipocontrato.idTipoContrato
    WHERE cs_calificacion.estado = 'PUBLICADO'
    GROUP BY cs_calificacion.idTipoContrato,
            cs_calificacion.idMetodo";
    $adq = Yii::app()->db->createCommand($sql)->queryAll();*/
    ?>
        <!--div class "row">
            <div class="col-md-12 col-xs-12 col-sm-12">
                <table class="display hover row-border" id="tabla_adquisiciones" cellspacing="0" style="width:100%;">
                    <thead>
                        <tr style="background:#29a4dd;color:#fff">
                            <th>Tipo de servicio contratado</th>
                            <th>Método de adquisición</th>
                            <th>Cantidad de contratos</th>


                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="background:#29a4dd;color:#fff">
                            <th>Tipo de servicio contratado</th>
                            <th>Método de adquisición</th>
                            <th>Cantidad de contratos</th>

                        </tr>
                    </tfoot>
                    <tbody>
                        <?php /*
            $row=0;
    $total_x=count($adq); ?>
                        <?php 
            while ($row< $total_x) {
                ?>
                        <tr>
                            <td>
                                <?php echo $adq[$row] ['contrato']; ?>
                            </td>
                            <td>
                                <?php echo $adq[$row] ['adquisicion']; ?>
                            </td>
                            <td>
                                <?php echo $adq[$row] ['contrato_cuantos']; ?>
                            </td>

                        </tr>

                        <?php $row++;
            } */?>
                    </tbody>
                </table>
            </div>
        </div>
    </div-->

    <script type="text/javascript">
        $(document).ready(function () {
            $('#tabla_adquisiciones').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
                "pagingType": "simple",
                "scrollX": "500",
                "processing": true,
                "info": true,
                "responsive": true

            });
        });

    </script>