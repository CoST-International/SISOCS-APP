<?php
/* @var $this FinanceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Finances',
);

$this->menu=array(
	array('label'=>'Crear Finance', 'url'=>array('create')),
	array('label'=>'Gestionar Finance', 'url'=>array('admin')),
);
?>

<h1>Finances</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
