<?php
/* @var $this DesembolsosMontosController */
/* @var $model DesembolsosMontos */

$this->breadcrumbs=array(
	'Desembolsos Montoses'=>array('index'),
	$model->idDesembolso=>array('view','id'=>$model->idDesembolso),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar DesembolsosMontos', 'url'=>array('index')),
	array('label'=>'Crear DesembolsosMontos', 'url'=>array('create')),
	array('label'=>'View DesembolsosMontos', 'url'=>array('view', 'id'=>$model->idDesembolso)),
	array('label'=>'Gestionar DesembolsosMontos', 'url'=>array('admin')),
);
?>

<h1>Actualizar DesembolsosMontos <?php echo $model->idDesembolso; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>