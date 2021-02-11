<?php
/* @var $this CalificacionOferenteController */
/* @var $model CalificacionOferente */

$this->breadcrumbs=array(
	'Calificacion Oferentes'=>array('index'),
	$model->idcalificacion=>array('view','id'=>$model->idcalificacion),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar CalificacionOferente', 'url'=>array('index')),
	array('label'=>'Crear CalificacionOferente', 'url'=>array('create')),
	array('label'=>'View CalificacionOferente', 'url'=>array('view', 'id'=>$model->idcalificacion)),
	array('label'=>'Gestionar CalificacionOferente', 'url'=>array('admin')),
);
?>

<h1>Actualizaci&oacute; Calificaci&oacute;n Oferente <?php echo $model->idcalificacion; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>