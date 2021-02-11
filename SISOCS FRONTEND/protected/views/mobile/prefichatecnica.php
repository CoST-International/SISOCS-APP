<?php
    /*
    var_dump($proyecto);
    echo '<hr>';
    var_dump($adquisicion);
    exit();*/
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/prefichatecnica.css');


?>
<!--
<div style="position:relative;width:350px;margin:auto">
    <div style="position:absolute;left:65px;top:65px">
        <input class="knob minute" value="99" readonly="readonly" data-min="0" data-max="100" data-bgColor="#333" data-displayInput=false data-width="100" data-height="100" data-thickness=".45">
    </div>
    <div style="position:absolute;left:90px;top:90px">
        <input class="knob second" value="22" readonly="readonly" data-min="0" data-max="100" data-bgColor="#333" data-fgColor="rgb(127, 255, 0)" data-displayInput=false data-width="50" data-height="50" data-thickness=".3">
    </div>
</div>
-->
<?php
/*
    var_dump($proyecto);
    echo '<HR/>';
    var_dump($adquisicion);
    exit();
*/
?>
<table style="alignment-adjust: center">
    <tbody>
        <tr>
            <td>
                <div class="pricing_table pricing_one"><!-- BEGIN TABLE CONTAINER -->
                    <div class="pricing_hover_area"><!-- BEGIN HOVER AREA -->
                        <ul class="pricing_column gradient_red"><!-- BEGIN FIRST CONTENT COLUMN -->
                            <li class="pricing_header1">
                                <table align="left" cellpadding="1" cellspacing="1" style="width:100%;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 82px;"><b>Codigo:</b></td>
                                            <td style="width: 99px; text-align: left;"><?php echo $proyecto[0]['proyecto_codigo'];?></td>
                                            <td style="width: 15px;">&nbsp;</td>
                                            <td style="width: 102px;"><b>Proyecto:</b></td>
                                            <td style="text-align: left; width: 645px;"><?php echo $proyecto[0]['proyecto_nombre'];?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li class="odd">
                                <?php echo "<b>Descripcion:</b><br/>".$proyecto[0]['proyecto_descripcion']; ?>
                            </li>
                            <li class="even">
                                <table cellpadding="1" cellspacing="1" style="width:100%;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 46px;"><b>Sector:</b></td>
                                            <td style="width: 169px;"><?php echo $proyecto[0]['proyecto_sector'];?></td>
                                            <td style="width: 10px;">&nbsp;</td>
                                            <td style="width: 80px;"><b>Sub Sector:</b></td>
                                            <td style="width: 242px;"><?php echo $proyecto[0]['proyecto_subsector'];?></td>
                                            <td style="width: 11px;">&nbsp;</td>
                                            <td style="width: 124px;"><b>Ente Responsable:</b></td>
                                            <td style="width: 285px;"><?php echo $proyecto[0]['proyecto_ente'];?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li class="odd">
                                <?php echo "<b>Propósito:</b><br/>".$proyecto[0]['proyecto_proposito']; ?>
                            </li>
                            <li class="even">
                                <table cellpadding="1" cellspacing="1" style="width:100%;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 182px;"><b>Fecha de aprobacion:</b></td>
                                            <td style="width: 98px;"><?php echo $proyecto[0]['proyecto_fecha_aprobacion'];?></td>
                                            <td style="width: 23px;">&nbsp;</td>
                                            <td style="width: 175px;"><b>Prespuesto en Lps.:</b></td>
                                            <td style="width: 565px;"><?php echo number_format($proyecto[0]['proyecto_presupuesto'], 2, '.', ',');?></td>
                                            <td style="width: 182px;"><b>Última Fecha de Modificación:</b></td>
                                            <?php $ultimaModificacionGarantias = Yii::app()->db->createCommand("SELECT max(garantias.fecha_publicacion) fecha FROM cs_garantias garantias
                                            JOIN cs_inicio_ejecucion inicioEjecucion
                                            ON
                                            inicioEjecucion.idInicioEjecucion = garantias.idInicioEjecucion
                                            JOIN cs_contratacion contratacion
                                            ON
                                            contratacion.idContratacion = inicioEjecucion.idContratacion
                                            JOIN cs_adjudicacion adju
                                            ON
                                            adju.idAdjudicacion = contratacion.idAdjudicacion
                                            JOIN cs_calificacion cali
                                            ON
                                            cali.idCalificacion = adju.idCalificacion
                                            WHERE cali.idProyecto=".$proyecto[0]['idProyecto'])->queryAll();

                                            $ultimaModificacionContratos = Yii::app()->db->createCommand("SELECT MAX(contratos.fecha_publicacion) fecha FROM cs_contratos contratos
                                            JOIN cs_contratacion contratacion
                                            ON
                                            contratacion.idContratacion= contratos.idContratacion
                                            JOIN cs_adjudicacion adju
                                            ON
                                            adju.idAdjudicacion = contratacion.idAdjudicacion
                                            JOIN cs_calificacion cali
                                            ON
                                            cali.idCalificacion= adju.idCalificacion
                                            WHERE idContratos =".$proyecto[0]['idProyecto'])->queryAll();

                                            $ultimaModificacionAvances = Yii::app()->db->createCommand("SELECT MAX(avances.fecha_publicacion) fecha FROM cs_avances avances
                                            JOIN cs_inicio_ejecucion inicioEjecucion
                                            ON
                                            inicioEjecucion.idInicioEjecucion= avances.idInicioEjecucion
                                            JOIN cs_contratacion contratacion
                                            ON
                                            contratacion.idContratacion = inicioEjecucion.idContratacion
                                            JOIN cs_adjudicacion adju
                                            ON
                                            adju.idAdjudicacion=contratacion.idAdjudicacion
                                            JOIN cs_calificacion cali
                                            ON
                                            cali.idCalificacion= adju.idCalificacion
                                            WHERE cali.idProyecto =".$proyecto[0]['idProyecto'])->queryAll();
                                            $ultimaModificacion= [$ultimaModificacionGarantias[0]['fecha'],$ultimaModificacionContratos[0]['fecha'],$ultimaModificacionAvances[0]['fecha']]
                                            ?>
                                            <td style="width: 98px;"><?php echo max($ultimaModificacion);?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li class="odd">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php
                                                    $rows = Yii::app()->db->createCommand("  SELECT DISTINCT
                                                                                                    `ncontrato`,
                                                                                                    `precioLPS`
                                                                                                FROM
                                                                                                    `cs_contratacion` inner join `vCiudadano` on
                                                                                                        `cs_contratacion`.`idContratacion` = `vCiudadano`.`idContratacion`
                                                                                                WHERE `idProyecto` = ".$proyecto[0]['idProyecto']
                                                                                          )->queryAll();
                                                    $data = array();
                                                    $total = 0;

                                                    foreach ($rows as $row) {
                                                        $total += $row['precioLPS'];
                                                    };

                                                    if ($total == 0) $total = 1;

                                                    foreach ($rows as $row) {
                                                        //array_push($data, array($row['ncontrato']. '; Lps.'.number_format($row['precioLPS'],2,'.',','), round(($row['precioLPS']/$total)*100,2)));
                                                        array_push($data, array('Lps.'.number_format($row['precioLPS'],2,'.',','), round(($row['precioLPS']/$total)*100,2)));
                                                    }

                                                    $this->Widget('ext.highcharts.HighchartsWidget',
                                                                array(  'options' => array(
                                                                                    //'colors'=> array('#0563FE', '#FF2F2F', '#6AC36A', '#FFD148',),
                                                                                    'exporting' => array('enabled' => false),
                                                                                    'chart' => array(
                                                                                        'height' => 400,
                                                                                        'width' => 600,
                                                                                    ),
                                                                                    'legend' => array(
                                                                                        'enabled' => false,
                                                                                    ),
                                                                                    'title' => array(
                                                                                        'text' => 'Distribucion de montos'
                                                                                    ),
                                                                                    'tooltip' => array(
                                                                                        'pointFormat' => '{series.name}: <b>{point.percentage}%</b>',
                                                                                        'percentageDecimals' => 1,
                                                                                    ),
                                                                                    'plotOptions' => array(
                                                                                                        'pie' => array(
                                                                                                            'allowPointSelect' => true,
                                                                                                            'cursor' => 'pointer',
                                                                                                            'dataLabels' => array(
                                                                                                                    'enabled' => true,
                                                                                                                    'color' => '#000000',
                                                                                                                    'connectorColor' => '#000000',
                                                                                                                    'formatter' => "js:function(){return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';}",
                                                                                                            ),
                                                                                                        )
                                                                                     ),
                                                                                    'series' => array(
                                                                                                    array(
                                                                                                        'type' => 'pie',
                                                                                                        'name' => '% de inversion',
                                                                                                        'data' => $data
                                                                                                    )
                                                                                    ),
                                                                           )
                                                                   )
                                                    );
                                                ?>
                                            </td>
                                            <td>
                                                <table align="center" border="1" cellpadding="1" cellspacing="1" style="width:80%;">
                                                    <caption><strong>Monto de cada contrato</strong></caption>
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 164px; text-align: center; background-color: rgb(51, 51, 51);"><span style="color:#ffffff;">Num. Contrato</span></th>
                                                            <th style="width: 167px; text-align: center; background-color: rgb(51, 51, 51);"><span style="color:#ffffff;">Monto en Lps.</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($rows as $row) { ?>
                                                        <tr>
                                                            <td style="width: 164px; text-align: center;"><?php echo $row['ncontrato']; ?></td>
                                                            <td style="width: 164px; text-align: center;"><?php echo number_format($row['precioLPS'], 2, '.', ','); ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                                <br/>
                                                <!-- Indocadores -->
                                                <?php

                                                    $transparencia = 0;
                                                    $montos = 0;
                                                    $plazo = 0;
                                                    $supervision = 0;
                                                    $contratos = 0;
                                                    $ejecucion = 0;
                                                    $cumplimiento = 0;
                                                    $divulgacion = 0;
                                                    $totali = 0;

                                                    $supervicion_actual = 0;
                                                    $supervision_original = 0;
                                                    $dsmonto = 0;
                                                    $dsplazo = 0;

                                                    $ejecucion_actual = 0;
                                                    $ejecucion_original = 0;
                                                    $demonto = 0;
                                                    $deplazo = 0;

                                                    $command = Yii::app()->db->createCommand("SELECT fn_indicador1(".$proyecto[0]['idProyecto'].");");
                                                    $transparencia = $command->queryScalar();

                                                    $command = Yii::app()->db->createCommand("SELECT fn_indicador2(".$proyecto[0]['idProyecto'].");");
                                                    $montos = $command->queryScalar();

                                                    $command = Yii::app()->db->createCommand("SELECT fn_indicador3(".$proyecto[0]['idProyecto'].");");
                                                    $plazo = $command->queryScalar();

                                                    $command = Yii::app()->db->createCommand("SELECT fn_indicador4(".$proyecto[0]['idProyecto'].");");
                                                    $supervision = $command->queryScalar();

                                                    $command = Yii::app()->db->createCommand("SELECT fn_indicador5(".$proyecto[0]['idProyecto'].");");
                                                    $contratos = $command->queryScalar();

                                                    $command = Yii::app()->db->createCommand("CALL sp_indicador6(".$proyecto[0]['idProyecto'].");");
                                                    $ejecucion = $command->queryScalar();

                                                    $command = Yii::app()->db->createCommand("SELECT fn_indicador7(".$proyecto[0]['idProyecto'].");");
                                                    $cumplimiento = $command->queryScalar();

                                                    $command = Yii::app()->db->createCommand("SELECT fn_indicador8(".$proyecto[0]['idProyecto'].");");
                                                    $divulgacion = $command->queryScalar();


                                                    $totali = $transparencia + $montos + $plazo + $supervision + $contratos + $ejecucion + $cumplimiento + $divulgacion;

                                                ?>
                                                <table align="center" border="1" cellpadding="1" cellspacing="1" style="width:80%;">
                                                    <caption><strong>Indicadores de Proceso</strong></caption>
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 164px; text-align: center; background-color: rgb(51, 51, 51);"><span style="color:#ffffff;">Indicador</span></th>
                                                            <th style="width: 167px; text-align: center; background-color: rgb(51, 51, 51);"><span style="color:#ffffff;">Valor</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>>
                                                        <tr>
                                                            <th style="width: 164px; text-align: center; background-color: rgb(51, 51, 51);"><span style="color:#ffffff;">TOTAL</span></th>
                                                            <th style="width: 167px; text-align: center; background-color: rgb(51, 51, 51);"><span style="color:#ffffff;"><?php echo number_format($totali, 2, '.', ','); ?></span></th>
                                                        </tr>
                                                    </tfoot>>
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 164px; text-align: center;">Gestión de la Adquisición</td>
                                                            <td style="width: 164px; text-align: center;"><?php echo number_format($transparencia, 2, '.', ','); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 164px; text-align: center;">Gestión de montos</td>
                                                            <td style="width: 164px; text-align: center;"><?php echo number_format($montos, 2, '.', ','); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 164px; text-align: center;">Gestión de plazos</td>
                                                            <td style="width: 164px; text-align: center;"><?php echo number_format($plazo, 2, '.', ','); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 164px; text-align: center;">Razonabilidad de la supervisión</td>
                                                            <td style="width: 164px; text-align: center;"><?php echo number_format($supervision, 2, '.', ','); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 164px; text-align: center;">Gestión de los contratos</td>
                                                            <td style="width: 164px; text-align: center;"><?php echo number_format($contratos, 2, '.', ','); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 164px; text-align: center;">Efectividad de la ejecución</td>
                                                            <td style="width: 164px; text-align: center;"><?php echo number_format($ejecucion, 2, '.', ','); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 164px; text-align: center;">Nota de prioridad</td>
                                                            <td style="width: 164px; text-align: center;"><?php echo number_format($cumplimiento, 2, '.', ','); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 164px; text-align: center;">Divulgación</td>
                                                            <td style="width: 164px; text-align: center;"><?php echo number_format($divulgacion, 2, '.', ','); ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                        </ul><!-- END FIRST CONTENT COLUMN -->
                    </div>
                </div>

            </td>
        </tr>
    </tbody>
</table>

<section>&nbsp;</section>

<section>
    <div class="pricing_table pricing_two"><!-- BEGIN TABLE CONTAINER -->
        <div class="pricing_hover_area"><!-- BEGIN HOVER AREA -->
            <?php
                $color="yellow";
                $fgColor = '#F4BA00';
                for($i=0;$i<count($adquisicion);$i++) {
                    if($i%2==0){
                        $color="yellow";
                        $fgColor = '#F4BA00';
                    } else {
                        $color="orange";
                        $fgColor = '#E47417';
                    }
                    if($idContratacion=$adquisicion[$i]['idContratacion']!=null){
                        $idContratacion=$adquisicion[$i]['idContratacion'];
                        $command = Yii::app()->db->createCommand("SELECT `fn_avance_programado`($idContratacion) AS `fn_avance_programado`");
                        $command2= Yii::app()->db->createCommand("SELECT `fn_avance_real`($idContratacion) AS `fn_avance_real`");
                        $avanceProgramado = $command->queryScalar();
                        $avanceReal = $command2->queryScalar();
                    } else {
                        $avanceProgramado=0;
                        $avanceReal=0;
                }
            ?>
            <ul class=<?php echo '"pricing_column gradient_'.$color.'"'?>>
                <li class="pricing_header1"><strong>Contrato # <?php echo $adquisicion[$i]['calificacion_numero'];?></strong></li>
                <li class="odd"><strong>Nombre:</strong><br/><?php echo $adquisicion[$i]['calificacion_nombre'];?></li>
                <li class="even">
                    <table align="center" border="1" cellpadding="1" cellspacing="1" style="width:80%;">
                        <caption><strong>Tiempos</strong></caption>
                        <tbody>
                            <tr>
                                <td style="width: 164px; text-align: center; background-color: rgb(51, 51, 51);"><span style="color:#ffffff;">Fecha de Inicio</span></td>
                                <td style="width: 167px; text-align: center; background-color: rgb(51, 51, 51);"><span style="color:#ffffff;">Fecha Final</span></td>
                                <td style="width: 134px; text-align: center; background-color: rgb(51, 51, 51);"><span style="color:#ffffff;">Duraci&oacute;n</span></td>
                            </tr>
                            <tr>
                                <td style="width: 164px; text-align: center;"><?php echo $adquisicion[$i]['contratacion_fecha_inicio'];?></td>
                                <td style="width: 164px; text-align: center;"><?php echo $adquisicion[$i]['contratacion_fecha_final'];?></td>
                                <td style="width: 164px; text-align: center;"><?php echo $adquisicion[$i]['contratacion_duracion'].' días';?></td>
                            </tr>
                        </tbody>
                    </table>
                </li>
                <li class="odd"><strong>Alcances:</strong><br/><?php echo $adquisicion[$i]['contratacion_alcances'];?></li>
                <li class="even"><strong>Metodo:</strong><?php echo $adquisicion[$i]['calificacion_metodo'];?></li>
                <li class="odd"><strong>Oferente:</strong> <?php echo $adquisicion[$i]['contratacion_oferente'];?></li>
                <li class="even">
                    <table cellpadding="1" cellspacing="1" style="width:100%;">
                        <tbody>
                            <tr>
                                <td style="width: 93px;"><strong>Monto en Lps.</strong></td>
                                <td style="width: 141px;"><?php echo number_format($adquisicion[$i]['contratacion_precioLPS'], 2, '.', ',');?></td>
                                <td style="width: 13px;">&nbsp;</td>
                                <td style="width: 93px;"><strong>Monto en USD</strong></td>
                                <td style="width: 119px;"><?php echo number_format($adquisicion[$i]['contratacion_precioUSD'], 2, '.', ',');?></td>
                            </tr>
                        </tbody>
                    </table>
                </li>
                <li class="odd">
                    <table align="center" cellpadding="1" cellspacing="1" style="width:92%;">
                        <tbody>
                            <tr>
                                <td style="width: 44%; text-align: center; border-top: 1px solid #ddd; border-left: 1px solid #ddd; border-right: 1px solid #ddd;">
                                    Avance Programado: <strong><?php echo number_format($avanceProgramado, 2, '.', ',').'%';?></strong>
                                </td>
                                <td style="width: 4%; text-align: center;">&nbsp;</td>
                                <td style="width: 44%; text-align: center; border-top: 1px solid #ddd; border-left: 1px solid #ddd; border-right: 1px solid #ddd;">
                                    Avance Real: <strong><?php echo number_format($avanceReal, 2, '.', ',').'%';?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 44%; text-align: center; border-bottom: 1px solid #ddd; border-left: 1px solid #ddd; border-right: 1px solid #ddd;">
                                    <?php
                                        $this->widget('ext.knob.knob', array(
                                                'data' => array(
                                                    'data-width' => ($avanceProgramado > $avanceReal)?'180':'150',
                                                    'data-thickness'=>0.2,
                                                    'value' => number_format($avanceProgramado,0),
                                                    'data-bgColor' => '#FFFFFF',
                                                    'data-fgColor' => $fgColor,
                                                    'data-angleArc' => 0,
                                                    'data-readOnly' =>true,
                                                    'data-skin' => 'tron'
                                                ),
                                            )
                                        );
                                    ?>
                                </td>
                                <td style="width: 4%; text-align: center;">&nbsp;</td>
                                <td style="width: 44%; text-align: center; border-bottom: 1px solid #ddd; border-left: 1px solid #ddd; border-right: 1px solid #ddd;">
                                    <?php
                                        $this->widget('ext.knob.knob', array(
                                                'data' => array(
                                                    'data-width' => ($avanceReal > $avanceProgramado)?'180':'150',
                                                    'data-thickness'=>0.2,
                                                    'value' => number_format($avanceReal, 0),
                                                    'data-bgColor' => '#FFFFFF',
                                                    'data-fgColor' => $fgColor,
                                                    'data-angleArc' => 0,
                                                    'data-readOnly' =>true,
                                                    'data-skin' => 'tron'
                                                ),
                                            )
                                        );
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </li>
                <?php
                    $control="";
                    $idFicha="";
                    if($adquisicion[$i]['idProyecto']!=null){
                        $control="Proyecto";
                        $idFicha=$adquisicion[$i]['idProyecto'];
                        if($adquisicion[$i]['idCalificacion']!=null){
                            $control="Calificacion";
                            $idFicha=$adquisicion[$i]['idCalificacion'];
                            if($adquisicion[$i]['idAdjudicacion']!=null){
                                $control="Adjudicacion";
                                $idFicha=$adquisicion[$i]['idAdjudicacion'];
                                if($adquisicion[$i]['idContratacion']!=null){
                                    $control="Contratacion";
                                    $idFicha=$adquisicion[$i]['idContratacion'];
                                }
                            }
                        }

                    }
                ?>
                <li class="pricing_footer">
                    <?php echo CHtml::link('Ver Ficha Tecnica', array('FichaTecnica', 'control'=>$control, 'id'=>$idFicha), array('class'=>'pricing_button')); ?>
                </li>
            </ul>
            <?php
            } ?>
        </div><!-- END HOVER AREA -->
    </div><!-- END TABLE CONTAINER -->
</section>

<?php

/*
$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options' => array(
      'title' => array('text' => 'Fruit Consumption'),
      'xAxis' => array(
         'categories' => array('Apples', 'Bananas', 'Oranges')
      ),
      'yAxis' => array(
         'title' => array('text' => 'Fruit eaten')
      ),
      'series' => array(
         array('name' => 'Jane', 'data' => array(1, 0, 4)),
         array('name' => 'John', 'data' => array(5, 7, 3))
      )
   )
));



$this->Widget('ext.highcharts.HighstockWidget', array(
  'options'=>array(
    'theme'=>'grid',
    'rangeSelector'=>array('selected'=>1),
    'title'=>array('text'=>'USD to EUR exchange rate'),
    'xAxis'=>array('maxZoom'=>14 * 24 * 3600000 ),
    'yAxis'=>array('title'=>array('text'=>'Exchange rate')),
    'series'=>array(array('name'=>'USD to EUR','data'=>'js:usdeur')),
  )));
Yii::app()->clientscript->registerScript('highstock',"
var usdeur = [
[Date.UTC(2003,8,24),0.8709],
[Date.UTC(2003,8,25),0.872],
[Date.UTC(2003,8,26),0.8714],
[Date.UTC(2011,4,10),0.6945]
];
",CClientScript::POS_HEAD);




$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options' => array(
      'title' => array('text' => 'Variacion en tiempo y precio'),
      'xAxis' => array(
         'categories' => array('Base','Duracion','Precio')
      ),
      'yAxis' => array(
         'title' => array('text' => 'Number of Visits')
      ),
      'colors'=>array('#6AC36A', '#FFD148', '#0563FE', '#FF2F2F'),
      'gradient' => array('enabled'=> true),
      'credits' => array('enabled' => false),
      'exporting' => array('enabled' => false),
      'chart' => array(
        'plotBackgroundColor' => '#ffffff',
        'plotBorderWidth' => null,
        'plotShadow' => false,
        'height' => 400,
        'type'=>'pie'
      ),
      'title' => false,
       'series' => array(
          array('name' => 'Original', 'data' => array(20)),
          array('name' => 'Variacion en tiempo', 'data' => array(20*1.5)),
          array('name' => 'Variacion en precio', 'data' => array(20*1.34))
      ),
    )
  ));

*/
?>
