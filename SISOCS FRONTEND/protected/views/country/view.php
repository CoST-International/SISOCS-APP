<?php
/* @var $this CountryController */
/* @var $model Country */

$this->breadcrumbs=array(
	'Countries'=>array('index'),
	$model->idCountry,
);

$this->menu=array(
	array('label'=>'Listar Country', 'url'=>array('index')),
	array('label'=>'Crear Country', 'url'=>array('create')),
	array('label'=>'Actualizar Country', 'url'=>array('update', 'id'=>$model->idCountry)),
	array('label'=>'Eliminar Country', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idCountry),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Country', 'url'=>array('admin')),
);
?>

<h1>View Country #<?php echo $model->idCountry; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idCountry',
		'descripcion',
	),
)); ?>
