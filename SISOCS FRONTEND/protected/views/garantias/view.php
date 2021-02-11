<?php
/* @var $this GarantiasController */
/* @var $model Garantias */

$this->breadcrumbs=array(
	'Garantias'=>array('index'),
	$model->idGarantia,
);

$this->menu=array(
	array('label'=>'Listar Garantias', 'url'=>array('index')),
	//array('label'=>'Crear Garantia', 'url'=>Yii::app()->createUrl("/garantias/create", array("idInicioEjecucion"=>$model->idInicioEjecucion))),
	array('label'=>'Crear Garantía', 'url'=>Yii::app()->createUrl("/garantias/create", array("id"=>$model->idInicioEjecucion))),
	array('label'=>'Actualizar Garantias', 'url'=>array('update', 'id'=>$model->idGarantia)),
	array('label'=>'Eliminar Garantias', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idGarantia),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestion Garantias', 'url'=>array('admin','id'=>Yii::app()->getSession()->get('idInicioEjecucion'))),
);
?>

<h1>View Garantias #<?php echo $model->idGarantia; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idGarantia',
		'idInicioEjecucion',
		'idTipoGarantia',
		'fecha_vencimiento',
		'monto',
		'estado',
		'usuario_creacion',
		'fecha_creacion',
		'usuario_publicacion',
		'fecha_publicacion',
	),
)); ?>
