
<?php
/* @var $this ProyectoController */
/* @var $model Proyecto */

$this->breadcrumbs=array(
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Proyectos', 'url'=>array('index')),
	array('label'=>'Gestionar Proyectos', 'url'=>array('admin')),
);
?>

<h1>Crear Planificación de Proyecto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
