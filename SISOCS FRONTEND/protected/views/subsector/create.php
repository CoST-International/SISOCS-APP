<?php
/* @var $this SubsectorController */
/* @var $model Subsector */

$this->breadcrumbs=array(
	//'Subsectors'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Listar Subsector', 'url'=>array('index')),
	array('label'=>'Gestionar Subsector', 'url'=>array('admin')),
);
?>

<h1>Crear Subsector</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
