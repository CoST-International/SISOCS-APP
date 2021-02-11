<?php
/* @var $this SectorController */
/* @var $model Sector */

$this->breadcrumbs=array(
	//'Sectors'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Listar Sector', 'url'=>array('index')),
	array('label'=>'Gestionar Sector', 'url'=>array('admin')),
);
?>

<h1>Crear Sector</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
