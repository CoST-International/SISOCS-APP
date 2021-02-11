<?php
/* @var $this CalificacionOferenteController */
/* @var $model CalificacionOferente */

$this->breadcrumbs=array(
	'Calificacion Oferentes'=>array('index'),
	$model->idCalificacion,
);

$this->menu=array(
	array('label'=>'Listar CalificacionOferente', 'url'=>array('index')),
	array('label'=>'Crear CalificacionOferente', 'url'=>array('create')),
	array('label'=>'Actualizar CalificacionOferente', 'url'=>array('update', 'id'=>$model->idCalificacion)),
	array('label'=>'Eliminar CalificacionOferente', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idCalificacion),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar CalificacionOferente', 'url'=>array('admin')),
);
?>

<h1>Ver CalificacionOferente #<?php echo $model->idCalificacion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idCalificacion',
		'idOferente',
	),
)); ?>
