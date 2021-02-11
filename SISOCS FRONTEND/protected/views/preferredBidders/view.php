<?php
/* @var $this PreferredBiddersController */
/* @var $model PreferredBidders */

$this->breadcrumbs=array(
	'Preferred Bidders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar PreferredBidders', 'url'=>array('index')),
	array('label'=>'Crear PreferredBidders', 'url'=>array('create')),
	array('label'=>'Actualizar PreferredBidders', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar PreferredBidders', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar PreferredBidders', 'url'=>array('admin')),
);
?>

<h1>View PreferredBidders #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idContratacion',
		'parties_id',
		'parties_name',
	),
)); ?>
