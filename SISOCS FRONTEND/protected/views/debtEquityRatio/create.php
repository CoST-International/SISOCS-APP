<?php
/* @var $this DebtEquityRatioController */
/* @var $model DebtEquityRatio */

$this->breadcrumbs=array(
	'Debt Equity Ratios'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar DebtEquityRatio', 'url'=>array('index')),
	array('label'=>'Gestionar DebtEquityRatio', 'url'=>array('admin')),
);
?>

<h1>Crear DebtEquityRatio</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>