<?php
/* @var $this RolController */
/* @var $model Rol */

$this->breadcrumbs=array(
	//'Rols'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Listar Rol', 'url'=>array('index')),
	array('label'=>'Gestionar Rol', 'url'=>array('admin')),
);
?>

<h1>Crear Rol</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
