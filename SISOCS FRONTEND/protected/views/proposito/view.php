<?php
/* @var $this PropositoController */
/* @var $model Proposito */

$this->breadcrumbs=array(
	//'Propositos'=>array('index'),
	$model->idProposito,
);

$this->menu=array(
	//array('label'=>'Listar Proposito', 'url'=>array('index')),
	array('label'=>'Crear Proposito', 'url'=>array('create')),
	//array('label'=>'Actualizar Proposito', 'url'=>array('update', 'id'=>$model->idProposito)),
	//array('label'=>'Eliminar Proposito', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idProposito),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Proposito', 'url'=>array('admin')),
);
?>

<h1>Ver Proposito #<?php echo $model->idProposito; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idProposito',
		'proposito',
	),
)); ?>
