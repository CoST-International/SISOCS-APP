<?php
/* @var $this FinanceCategoryController */
/* @var $model FinanceCategory */

$this->breadcrumbs=array(
	'Finance Categories'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar FinanceCategory', 'url'=>array('index')),
	array('label'=>'Gestionar FinanceCategory', 'url'=>array('admin')),
);
?>

<h1>Crear FinanceCategory</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>