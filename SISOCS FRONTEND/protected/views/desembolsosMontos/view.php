<?php
/* @var $this DesembolsosMontosController */
/* @var $model DesembolsosMontos */

$this->breadcrumbs=array(
	'Desembolsos Montoses'=>array('index'),
	$model->idDesembolso,
);

$this->menu=array(
	array('label'=>'Listar DesembolsosMontos', 'url'=>array('index')),
	array('label'=>'Crear DesembolsosMontos', 'url'=>array('create')),
	array('label'=>'Actualizar DesembolsosMontos', 'url'=>array('update', 'id'=>$model->idDesembolso)),
	array('label'=>'Eliminar DesembolsosMontos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idDesembolso),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar DesembolsosMontos', 'url'=>array('admin')),
);
?>

<h1>View DesembolsosMontos #<?php echo $model->idDesembolso; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idDesembolso',
		'idInicioEjecucion',
		'desembolso',
		'monto',
		'descripcion',
		'fecha_desembolso',
		'estado',
		'usuario_creacion',
		'fecha_creacion',
		'usuario_publicacion',
		'fecha_publicacion',
	),
)); ?>
