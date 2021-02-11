<?php

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/informes_tabla.css');

$data_rows = Yii::app()->db->createCommand(" SELECT 
                                        	cs_tipocontrato.contrato, 
                                        	cs_metodo.adquisicion,
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

foreach($adq_rows as $adq) {
    foreach ($cat_rows as $cat) {
		$found = false;
		foreach ($data_rows as $row) {
			if(($cat['contrato'] == $row['contrato']) && ($adq['adquisicion'] == $row['adquisicion'])) {
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
for($i=0;$i<count($metodo);$i++) {
	$porcentaje = 0;
	foreach($data_rows as $row) {
		if ($metodo[$i][0] == $row['adquisicion']) {
			$porcentaje += $row['contrato_cuantos']*1;
		}
	}
	$metodo[$i][1] = $porcentaje;
	$metodo[$i][2] = 'js:Highcharts.getOptions().colors['.$i.']';
	$total += $porcentaje;
}
for($i=0;$i<count($metodo);$i++) {
	if ($total > 0) {
		$metodo[$i][1] = $metodo[$i][1]/$total;
	}
}
for($i=0;$i<count($metodo);$i++) {
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

$this->widget('ext.highcharts.HighchartsWidget', array(
    'scripts' => array(
        'modules/exporting',
        'themes/grid-light',
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


echo '<div class="wrapper">
                <div class="table">
                    <div class="row header blue">
                        <div class="cell">Tipo de servicio contratado</div>
                        <div class="cell">Metodo de adquisicion</div>
                        <div class="cell">Cantidad de contratos</div>
                    </div>';
            
            
            foreach ($data_rows as $row) {
                echo '        <div class="row"> ';
                echo '          <div class="cell">' . $row['contrato'] . '</div>';
                echo '          <div class="cell">' . $row['adquisicion'] . '</div>';
                echo '          <div class="cell">' . $row['contrato_cuantos'] . '</div>';
                echo '      </div>';
            }
            echo '    
              </div>
            </div>';
            
?>




<div width="50%>

<?php


$columnsArray = array('id','name','lastname','tel','email');
            $rowsArray = array(
            	array(1,'Jose','Rullan','123-123-1234','jose@email.com'),
            	array(2,'Fred','Frederick','123-123-1234','fred@email.com'),
            	array(3,'Paul','Horstmann','123-123-1234','phor@email.com'),
            	array(4,'Kim','Guptha','123-123-1234','kgup@email.com'),
            	array(5,'Fred','Frederick','123-123-1234','fred@email.com'),
            	array(6,'Querty','Uiop','123-123-1234','querty@email.com'),
            	array(7,'Albert','Febensburg','123-123-1234','a@email.com'),
            	array(8,'Dan','Sieg','123-123-1234','da@email.com'),
            	array(9,'Janice','Breyfogle','123-123-1234','janice@email.com'),
            	array(10,'Cornelious','Ape','123-123-1234','potapes@email.com'),
            );

            $this->widget('ext.htmltableui.htmlTableUi',array(
            	'collapsed'=>true,
            	'enableSort'=>true,
            	'title'=>'My Simple HTML Table',
            	'subtitle'=>'Rev 1.3.3',
            	'columns'=>$columnsArray,
            	'rows'=>$rowsArray,
            	'footer'=>'Total rows: '.count($rowsArray).' By: José Rullán'
            ));

            

?>
</div>
