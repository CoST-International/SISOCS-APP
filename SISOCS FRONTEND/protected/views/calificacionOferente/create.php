<?php
/* @var $this CalificacionOferenteController */
/* @var $model CalificacionOferente */

$this->breadcrumbs=array(
	'Calificacion Oferentes'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar CalificacionOferente', 'url'=>array('index')),
	array('label'=>'Gestionar CalificacionOferente', 'url'=>array('admin')),
);
?>

<h1>Crear Calificaci&oacute;n de Oferente</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'id'=>$id)); ?>