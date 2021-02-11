<?php
/* @var $this DebtEquityRatioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Debt Equity Ratios',
);

$this->menu=array(
	array('label'=>'Crear DebtEquityRatio', 'url'=>array('create')),
	array('label'=>'Gestionar DebtEquityRatio', 'url'=>array('admin')),
);
?>

<h1>Debt Equity Ratios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
