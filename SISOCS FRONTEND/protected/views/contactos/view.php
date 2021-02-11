<?php
/* @var $this ContactosController */
/* @var $model Contactos */

$this->breadcrumbs=array(
	//'Contactoses'=>array('index'),
	$model->idContacto,
);

$this->menu=array(
	//array('label'=>'Listar Contactos', 'url'=>array('index')),
	array('label'=>'Crear Contactos', 'url'=>array('create')),
	array('label'=>'Actualizar Contactos', 'url'=>array('update', 'id'=>$model->idContacto)),
	//array('label'=>'Eliminar Contactos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idContacto),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Contactos', 'url'=>array('admin')),
);
?>

<h1>Ver Contactos #<?php echo $model->idContacto; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idContacto',
		'Nombres',
		'direccion',
		'telefono',
		'movil',
		'email',
	),
)); ?>
