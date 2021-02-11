<?php
/* @var $this SectorController */
/* @var $model Sector */

$this->breadcrumbs=array(
	//'Sectors'=>array('index'),
	$model->idSector,
);

$this->menu=array(
	//array('label'=>'Listar Sector', 'url'=>array('index')),
	array('label'=>'Crear Sector', 'url'=>array('create')),
	//array('label'=>'Actualizar Sector', 'url'=>array('update', 'id'=>$model->idSector)),
	//array('label'=>'Eliminar Sector', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idSector),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Sector', 'url'=>array('admin')),
);
?>

<h1>Ver Sector #<?php echo $model->idSector; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idSector',
		'sector',
	),
)); ?>
