<?php
/* @var $this FinanceController */
/* @var $model Finance */

$this->breadcrumbs=array(
	'Finances'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Finance', 'url'=>array('index')),
	array('label'=>'Gestionar Finance', 'url'=>array('admin')),
);
?>

<h1>Crear Finance</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>