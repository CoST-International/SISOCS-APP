<?php
/* @var $this MetodoAdjudicacionController */
/* @var $model MetodoAdjudicacion */

$this->breadcrumbs=array(
	//'Metodo Adjudicacions'=>array('index'),
	$model->idMetodoAdjudicacion,
);

$this->menu=array(
	//array('label'=>'Listar MetodoAdjudicacion', 'url'=>array('index')),
	array('label'=>'Crear MetodoAdjudicacion', 'url'=>array('create')),
	//array('label'=>'Actualizar MetodoAdjudicacion', 'url'=>array('update', 'id'=>$model->idMetodoAdjudicacion)),
	//array('label'=>'Eliminar MetodoAdjudicacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idMetodoAdjudicacion),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar MetodoAdjudicacion', 'url'=>array('admin')),
);
?>

<h1>Ver MetodoAdjudicacion #<?php echo $model->idMetodoAdjudicacion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idMetodoAdjudicacion',
		'nombre',
	),
)); ?>
