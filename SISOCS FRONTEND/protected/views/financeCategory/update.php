<?php
/* @var $this FinanceCategoryController */
/* @var $model FinanceCategory */

$this->breadcrumbs=array(
	'Finance Categories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar FinanceCategory', 'url'=>array('index')),
	array('label'=>'Crear FinanceCategory', 'url'=>array('create')),
	array('label'=>'View FinanceCategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar FinanceCategory', 'url'=>array('admin')),
);
?>

<h1>Actualizar FinanceCategory <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>