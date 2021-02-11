<?php
/* @var $this SubsectorController */
/* @var $model Subsector */

$this->breadcrumbs=array(
	//'Subsectors'=>array('index'),
	$model->idSubSector,
);

$this->menu=array(
	//array('label'=>'Listar Subsector', 'url'=>array('index')),
	array('label'=>'Crear Subsector', 'url'=>array('create')),
	//array('label'=>'Actualizar Subsector', 'url'=>array('update', 'id'=>$model->idSubSector)),
	//array('label'=>'Eliminar Subsector', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idSubSector),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Subsector', 'url'=>array('admin')),
);
?>

<h1>Ver Subsector #<?php echo $model->idSubSector; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idSubSector',
		'idSector0.sector',
		'subsector',
	),
)); ?>
