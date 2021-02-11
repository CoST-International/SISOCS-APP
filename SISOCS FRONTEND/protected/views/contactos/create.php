<?php
/* @var $this ContactosController */
/* @var $model Contactos */

$this->breadcrumbs=array(
	//'Contactoses'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Listar Contactos', 'url'=>array('index')),
	array('label'=>'Gestionar Contactos', 'url'=>array('admin')),
);
?>

<h1>Crear Contactos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
