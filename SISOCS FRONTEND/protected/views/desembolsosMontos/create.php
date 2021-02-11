<?php
/* @var $this DesembolsosMontosController */
/* @var $model DesembolsosMontos */

$this->breadcrumbs=array(
	'Desembolsos Montoses'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar DesembolsosMontos', 'url'=>array('index')),
	array('label'=>'Gestionar DesembolsosMontos', 'url'=>array('admin')),
);
?>

<h1>Crear DesembolsosMontos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>