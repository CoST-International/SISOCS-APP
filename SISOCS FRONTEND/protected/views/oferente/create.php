<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->breadcrumbs=array(
	//'Oferentes'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Listar Oferente', 'url'=>array('index')),
	array('label'=>'Administrar Oferente', 'url'=>array('admin')),
);
?>

<h1>Crear Oferente</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
