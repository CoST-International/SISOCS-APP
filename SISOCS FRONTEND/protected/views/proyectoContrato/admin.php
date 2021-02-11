<?php
/* @var $this ProyectoContratoController */
/* @var $model ProyectoContrato */

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/informes_tabla.css');

?>

<h1>Descarga de informacion de proyectos y contratos</h1>

<?php 


$data_rows = Yii::app()->db->createCommand("SELECT * FROM cs_vProyectoContrato")->queryAll();

print_r($data_rows);

/*
$this->widget('zii.widgets.grid.CGridView', 
              array('dataProvider' => $model->search(),
                    'filter' => $model,
                    'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
                    'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
                    'summaryText' => 'Mostrando {start} - {end} de {count} registros',
                    'htmlOptions' => array('class' => 'grid-view rounded'),
                    'columns' => array(
                                        'idProyecto',
                                        'idCalificacion',
                                        'idAdjudicacion',
                                        'idContratacion',
                                        'proyecto_codigo',
                                        'proyecto_nombre',
                                        'proyecto_descripcion',
                                        'proyecto_proposito',
                                        'proyecto_ambiental',
                                        'proyecto_reasentamiento',
                                        'proyecto_fecha_aprobacion',
                                        'proyecto_presupuesto',
                                        'proyecto_departamento',
                                        'proyecto_municipio',
                                        'proyecto_beneficio',
                                        'proyecto_fuente',
                                        'proyecto_fuente_monto',
                                        'proyecto_fuente_moneda',
                                        'proyecto_sector',
                                        'proyecto_subsector   ',
                                        'proyecto_ente',
                                        'proyecto_funcionario_nombre',
                                        'calificacion_ente   ',
                                        'calificacion_numero',
                                        'calificacion_nombre',
                                        'calificacion_oferente',
                                        'adjudicacion_metodo',
                                        'calificacion_metodo   ',
                                        'calificacion_funcionario_nombre',
                                        'adjudicacion_tipo_contrato',
                                        'contratacion_oferente',
                                        'contratacion_alcances',
                                        'contratacion_precioLPS',
                                        'contratacion_precioUSD',
                                        'contratacion_fecha_inicio',
                                        'contratacion_fecha_final',
                                        'contratacion_duracion',
                                        array('htmlOptions'=>array('width'=>'140',
                                                                   'style'=>'text-align:center'),
                                              'header' => 'Acciones',
                                              'class' => 'CButtonColumn',
                                              'template' => '{view}',
                                        ),
                                 ),
              )
); 
*/
?>

