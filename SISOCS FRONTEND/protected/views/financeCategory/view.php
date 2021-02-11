<?php
/* @var $this FinanceCategoryController */
/* @var $model FinanceCategory */

$this->breadcrumbs=array(
	'Finance Categories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar FinanceCategory', 'url'=>array('index')),
	array('label'=>'Crear FinanceCategory', 'url'=>array('create')),
	array('label'=>'Actualizar FinanceCategory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar FinanceCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar FinanceCategory', 'url'=>array('admin')),
);
?>

<h1>View FinanceCategory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'descripcion',
	),
)); ?>
