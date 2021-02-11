<?php
/* @var $this RolController */
/* @var $model Rol */

$this->breadcrumbs=array(
	//'Rols'=>array('index'),
	//$model->idRol=>array('view','id'=>$model->idRol),
	'Actualizar',
);

$this->menu=array(
	//array('label'=>'Listar Rol', 'url'=>array('index')),
	array('label'=>'Crear Rol', 'url'=>array('create')),
	//array('label'=>'Ver Rol', 'url'=>array('view', 'id'=>$model->idRol)),
	array('label'=>'Gestionar Rol', 'url'=>array('admin')),
);
?>

<h1>Actualizar Rol <?php echo $model->idRol; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
