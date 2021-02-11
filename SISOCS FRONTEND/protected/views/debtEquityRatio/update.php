<?php
/* @var $this DebtEquityRatioController */
/* @var $model DebtEquityRatio */

$this->breadcrumbs=array(
	'Debt Equity Ratios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar DebtEquityRatio', 'url'=>array('index')),
	array('label'=>'Crear DebtEquityRatio', 'url'=>array('create')),
	array('label'=>'View DebtEquityRatio', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar DebtEquityRatio', 'url'=>array('admin')),
);
?>

<h1>Actualizar DebtEquityRatio <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>