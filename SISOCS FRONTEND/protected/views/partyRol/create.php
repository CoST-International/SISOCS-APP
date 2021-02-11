<?php
/* @var $this PartyRolController */
/* @var $model PartyRol */

$this->breadcrumbs=array(
	'Party Rols'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar PartyRol', 'url'=>array('index')),
	array('label'=>'Gestionar PartyRol', 'url'=>array('admin')),
);
?>

<h1>Crear PartyRol</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>