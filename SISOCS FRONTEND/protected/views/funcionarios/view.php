<?php
/* @var $this FuncionariosController */
/* @var $model Funcionarios */

$this->breadcrumbs=array(
	//'Funcionarios'=>array('index'),
	$model->idFuncionario,
);

$this->menu=array(
	//array('label'=>'Listar Funcionarios', 'url'=>array('index')),
	array('label'=>'Crear Funcionario', 'url'=>array('create')),
	array('label'=>'Actualizar Funcionario', 'url'=>array('update', 'id'=>$model->idFuncionario)),
	//array('label'=>'Eliminar Funcionarios', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idFuncionario),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Funcionario', 'url'=>array('admin')),
);
?>

<h1>Ver Funcionario #<?php echo $model->idFuncionario; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idFuncionario',
		'idEnte',
		'nombre',
		'puesto',
		'telefono',
		'correo',
		'idUnidad0.nombre',
	),
)); ?>
