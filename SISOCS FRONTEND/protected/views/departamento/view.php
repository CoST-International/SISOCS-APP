<?php
/* @var $this DepartamentoController */
/* @var $model Departamento */

$this->breadcrumbs=array(
	//'Departamentos'=>array('index'),
	$model->idDepartamento,
);

$this->menu=array(
	//array('label'=>'Listar Departamento', 'url'=>array('index')),
	array('label'=>'Crear Departamento', 'url'=>array('create')),
	//array('label'=>'Actualizar Departamento', 'url'=>array('update', 'id'=>$model->idDepartamento)),
	//array('label'=>'Eliminar Departamento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idDepartamento),'confirm'=>'¿Seguro que desea eliminar el Departamento?')),
	array('label'=>'Gestionar Departamento', 'url'=>array('admin')),
);
?>

<h1>Ver Departamento #<?php echo $model->idDepartamento; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idDepartamento',
		'departamento',
	),
)); ?>
