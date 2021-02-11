<?php
/* @var $this ContactosController */
/* @var $model Contactos */

$this->breadcrumbs=array(
	//'Contactoses'=>array('index'),
	//$model->idContacto=>array('view','id'=>$model->idContacto),
	'Actualizar',
);

$this->menu=array(
	//array('label'=>'Listar Contactos', 'url'=>array('index')),
	array('label'=>'Crear Contactos', 'url'=>array('create')),
	//array('label'=>'View Contactos', 'url'=>array('view', 'id'=>$model->idContacto)),
	array('label'=>'Gestionar Contactos', 'url'=>array('admin')),
);
?>

<h1>Actualizar Contactos <?php echo $model->idContacto; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
