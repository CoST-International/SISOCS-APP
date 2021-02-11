<?php
/* @var $this PartyRolController */
/* @var $model PartyRol */

$this->breadcrumbs=array(
	'Party Rols'=>array('index'),
	$model->idRol=>array('view','id'=>$model->idRol),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar PartyRol', 'url'=>array('index')),
	array('label'=>'Crear PartyRol', 'url'=>array('create')),
	array('label'=>'View PartyRol', 'url'=>array('view', 'id'=>$model->idRol)),
	array('label'=>'Gestionar PartyRol', 'url'=>array('admin')),
);
?>

<h1>Actualizar PartyRol <?php echo $model->idRol; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>