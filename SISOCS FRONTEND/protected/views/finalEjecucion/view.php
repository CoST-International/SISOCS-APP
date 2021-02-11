<?php
/* @var $this FinalEjecucionController */
/* @var $model FinalEjecucion */

$this->breadcrumbs=array(
	'Finalización de Contratos'=>array('index'),
	$model->idFinalizacion,
);


if ($model->estado === 'PUBLICADO') {
  $this->menu=array(
	        array('label'=>'Listar Contratos no finalizados', 'url'=>array('GestionFinales/admin')),
	        array('label'=>'Lista de finalizaciones (Publicadas)', 'url'=>array('GestionFinales/publicadas')),
            array('label'=>'Gestionar finalizaciones', 'url'=>array('admin')),
        );
} else {
  $this->menu=array(
	        array('label'=>'Actualizar Finalización de contrato', 'url'=>array('update', 'id'=>$model->idFinalizacion)),
	        array('label'=>'Listar Contratos no finalizados', 'url'=>array('GestionFinales/admin')),
	        array('label'=>'Lista de finalizaciones (Publicadas)', 'url'=>array('GestionFinales/publicadas')),
            array('label'=>'Gestionar finalizaciones', 'url'=>array('admin')),
        );
}

?>

<h1>Ver Finalización de Contratos #<?php echo $model->idFinalizacion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        'idFinalizacion',
		'idInicioEjecucion',
		'costoFinalizacion',
		'alcanceFinalizacion',
		'fechaFinalizacion',
        'adj_documentoGarantia',
		'adj_actaRecepcion',
		'adj_informesEvaluacion',
		'adj_informeDisconformidad',
		'adj_informeAseguramientoCalidad',
		'razonesCambios',
		'estadoContratoActual',
		'usuario_creacion',
		'fecha_creacion',
        'usuario_publicacion',
		'fecha_publicacion',
	),
)); ?>
